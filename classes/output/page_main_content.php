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
 * @copyright  2026 Your Name
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
     * @param $manager
     * @param $userid
     */
    public function __construct($manager, $userid = null) {
        $this->manager = $manager;
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
        $data['title'] = $this->manager->private_shares->title;
        $data['hastext'] = !empty($this->manager->private_shares->text);
        $data['text'] = $this->manager->private_shares->text;
        $data['shares'] = $this->manager->private_shares->shares;
        $data['usershare'] = $this->manager->private_shares->usershare;
        $data['isteacher'] = $this->manager->private_shares->isteacher;
        $data['hasfilename'] = $this->manager->private_shares->hasfilename;
        $data['filename'] = $this->manager->private_shares->filename;
        $data['error_usershare'] = get_string('error_no_usershare', 'block_private_shares');

        return $data;
    }
}
