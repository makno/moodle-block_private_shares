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

/**
 * Library functionalities for block.
 * @package    block_private_shares
 * @copyright  2026 Mathias Knoll
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Pluginfile.
 * @package    block_private_shares
 * @copyright  2026 Mathias Knoll
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Serves private shares files.
 * @package    block_private_shares
 * @copyright  2026 Mathias Knoll
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @param stdClass $course The course object.
 * @param stdClass $cm The course module object.
 * @param context $context The context for the file.
 * @param string $filearea The file area being requested.
 * @param array $args Extra arguments, typically the filepath and filename.
 * @param bool $forcedownload Whether or not to force download.
 * @param array $options Additional options (optional).
 * @return void Sends the file or does nothing if not found.
 */
function block_private_shares_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = []) {
    global $CFG;
}
/**
 * Adds items to the My Profile navigation tree for private shares.
 * @package    block_private_shares
 * @copyright  2026 Mathias Knoll
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @param \core_user\output\myprofile\tree $tree The profile navigation tree.
 * @param stdClass $user The user object for whom the navigation is displayed.
 * @param bool $iscurrentuser Whether the profile belongs to the current user.
 * @param stdClass $course The course object context for this navigation.
 * @return void
 */
function block_private_shares_myprofile_navigation(\core_user\output\myprofile\tree $tree, $user, $iscurrentuser, $course) {
    global $PAGE;
}
