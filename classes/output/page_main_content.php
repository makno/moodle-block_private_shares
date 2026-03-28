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
//
// @package    block_private_shares
// @copyright  2026 Mathias Knoll
// @license    https://www.gnu.org/licenses/agpl-3.0.html GNU AFFERO GENERAL PUBLIC LICENSE Version 3, 19 November 2007.

namespace block_private_shares\output;

use renderable;
use renderer_base;
use templatable;
use moodle_url;

/**
 * Handle main content of block.
 *
 * @package    block_private_shares
 * @copyright  2026 Mathias Knoll
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class page_main_content implements renderable, templatable {
    /**
     * @var Manager
     */
    protected $manager;
    /**
     * User Id.
     * @var mixed|null
     */
    protected $userid;
    /**
     * Constructor using manager and user.
     * @param manager $tmpmanager The manager instance.
     * @param int|null $userid The user ID, or null for the current user.
     */
    public function __construct($tmpmanager, $userid = null) {
        $this->manager = $tmpmanager;
        $this->userid = $userid;
    }
    /**
     * Prepare data for rendering in moustache.
     * @param renderer_base $output
     * @return array
     */
    public function export_for_template(renderer_base $output) {
        global $DB, $USER;
        $data = [];
        $data['img_logo'] = $output->image_url('logo', 'block_private_shares');
        $data['title'] = $this->manager->privateshares->title;
        $data['hastext'] = !empty($this->manager->privateshares->text);
        $data['text'] = $this->manager->privateshares->text;
        $data['shares'] = $this->manager->privateshares->shares;
        $data['usershare'] = $this->manager->privateshares->usershare;
        $data['isteacher'] = $this->manager->privateshares->isteacher;
        $data['hasfilename'] = $this->manager->privateshares->hasfilename;
        $data['filename'] = $this->manager->privateshares->filename;
        $data['error_usershare'] = get_string('error_no_usershare', 'block_private_shares');
        return $data;
    }
}
