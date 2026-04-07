<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <https://www.gnu.org/licenses/>.
// @package    block_private_shares
// @copyright  2026 Mathias Knoll
// @license    https://www.gnu.org/licenses/agpl-3.0.html GNU AFFERO GENERAL PUBLIC LICENSE Version 3, 19 November 2007.

/**
 * Block that handles private shares.
 *
 * @package    block_private_shares
 * @copyright  2026 Mathias Knoll
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_private_shares extends block_base {
    /**
     * Ig filename is given for the shared data.
     * @var bool
     */
    public $hasfilename = false;
    /**
     * File name for download.
     * @var string
     */
    public $filename = '';
    /**
     * Array of share of user.
     * @var array
     */
    public $usershare = [];
    /**
     * Array of shares.
     * @var array
     */
    public $shares = [];
    /**
     * Text with hint on the content.
     * @var string
     */
    public $text = '';
    /**
     * If user is in role teacher (view is different).
     * @var bool
     */
    public $isteacher = false;

    /**
     * Initialize plugin.
     * @return void
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_private_shares');
    }
    /**
     * Das it have a configuration?
     * @return true
     */
    public function has_config() {
        return true;
    }
    /**
     * Is a configuration allowed in instance?
     * @return false
     */
    public function instance_allow_config() {
        return false;
    }
    /**
     * Are multiple instances allowed? (Nope)
     * @return false
     */
    public function instance_allow_multiple() {
        return false;
    }
    /**
     * For Cron (no functionality applied.)
     * @return true
     */
    public function cron() {
        mtrace("Hey, my cron script is running?!");
        return true;
    }
    /**
     * Hide header of block (Nope)
     * @return false
     */
    public function hide_header() {
        return false;
    }
    /**
     * Tell, where the block may be used.
     * Only in course!
     * @return array
     */
    public function applicable_formats() {
        return [
            'all' => false,
            'site' => false,
            'site-index' => false,
            'course-view' => true,
            'course-view-social' => false,
            'mod' => false,
            'mod-quiz' => false,
        ];
    }
    /**
     * Get content.
     * @return stdClass|string
     */
    public function get_content() {
        global $CFG, $OUTPUT;
        if ($this->content !== null) {
            return $this->content;
        }
        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }
        $this->content          = new stdClass();
        $this->content->items   = [];
        $this->content->icons   = [];
        $this->content->text    = '';
        $this->content->footer  = '';
        $manager = \block_private_shares\manager::get($this);
        $renderer = $this->page->get_renderer('block_private_shares');
        $page = new \block_private_shares\output\page_main_content($manager);
        $this->content->text = $renderer->render($page);
        return $this->content;
    }
    /**
     * Specialization.
     * @return void
     */
    public function specialization() {
        global $USER, $COURSE;
        if (isset($this->config)) {
            if (!empty($this->config->title)) {
                $this->title = $this->config->title;
            }
            if (!empty($this->config->text)) {
                $this->text = $this->config->text;
            }
            if (!empty($this->config->filename)) {
                $this->hasfilename = true;
                $this->filename = $this->config->filename;
            }
            if (!empty($this->config->shares)) {
                // Get context.
                $context = context_course::instance($COURSE->id);
                // Get rolename of current user.
                $roles = get_user_roles($context, $USER->id, true);
                $role = key($roles);
                $rolename = $roles[$role]->shortname;
                if ($rolename == "editingteacher" || $rolename == "teacher") {
                    $this->isteacher = true;
                }
                // Generate private shares for each user.
                $this->generate_private_share($this->config->shares);
            }
        }
    }

    /**
     * Specialization.
     * @param string $shares
     * @return void
     * @throws coding_exception
     * @throws dml_exception
     */
    private function generate_private_share($shares) {
        global $DB, $USER;

        $lengthshortformat = 50;

        $lines = preg_split('/((\r?\n)|(\r\n?))/', $shares);

        $usernames = [];
        foreach ($lines as $line) {
            $arrayfromline = explode(',', $line);
            if (count($arrayfromline) == 2) {
                $usernames[] = $arrayfromline[0];
            }
        }

        $usernames = array_unique($usernames);

        [$sql, $params] = $DB->get_in_or_equal($usernames, SQL_PARAMS_NAMED);

        $users = $DB->get_records_sql("SELECT id, username FROM {user} WHERE username $sql", $params);

        // Re-index by username for fast lookup.
        $usersbyname = [];
        foreach ($users as $u) {
            $usersbyname[$u->username] = $u;
        }

        // Check shares file.
        $size = 2;
        $countlines = 1;
        foreach ($lines as $line) {
            $arrayfromline = explode(',', $line);
            $l = [];
            $l['serror'] = false;
            $l['serrortext'] = '';
            if (count($arrayfromline) == $size) {
                // Field 1 Username.
                if (isset($usersbyname[$arrayfromline[0]])) {
                    $l['sname'] = $arrayfromline[0];
                } else {
                    $l['serror'] = true;
                    $prm = new stdClass();
                    $prm->line = $countlines;
                    $prm->username = $arrayfromline[0];
                    $l['serrortext'] = get_string('error_user_not_existing', 'block_private_shares', $prm);
                    $this->shares[] = $l;
                }
                // Field 2 Base64 Code.
                $str = base64_decode($arrayfromline[1], true);
                if ($str === false) {
                    $l['serror'] = true;
                    $prm = new stdClass();
                    $prm->line = $countlines;
                    $l['serrortext'] = get_string('error_no_base64', 'block_private_shares', $prm);
                    $this->shares[] = $l;
                } else {
                    $l['stextbase64'] = $arrayfromline[1];
                    $l['stext'] = $str;
                    if (strlen($str) > 100) {
                        $l['stextshort'] = substr($str, 0, 50) . ' ... ' . substr($str, strlen($str) - $lengthshortformat);
                    } else {
                        $l['stextshort'] = $str;
                    }
                }
            } else {
                $l['serror'] = true;
                $prm = new stdClass();
                $prm->line = $countlines;
                $l['serrortext'] = get_string('error_number_fields', 'block_private_shares', $prm);
                $this->shares[] = $l;
            }
            if (array_key_exists('sname', $l) && $l['sname'] === $USER->username) {
                $this->usershare[] = $l;
            }
            if ($l['serror'] == false) {
                $this->shares[] = $l;
            }
            $countlines++;
        }
    }

    /**
     * Save configuration.
     * @param stdClass $data Configuration data.
     * @param bool $nolongerused Unused parameter (kept for backward compatibility).
     * @return bool True if the configuration was successfully saved.
     */
    public function instance_config_save($data, $nolongerused = false) {
        if (get_config('private_shares', 'how_header') == '1') {
            $data->text = strip_tags($data->text);
        }
        // And now forward to the default implementation defined in the parent class.
        return parent::instance_config_save($data, $nolongerused);
    }
    /**
     * Set class.
     * @return mixed
     */
    public function html_attributes() {
        $attributes = parent::html_attributes(); // Get default values.
        $attributes['class'] .= ' block_' . $this->name(); // Append our class to class attribute.
        return $attributes;
    }
}
