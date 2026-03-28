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
 * Settings for block.
 * @package    block_private_shares
 * @copyright  2026 Mathias Knoll
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

/** @var Settings $settings */
$settings->add(new admin_setting_heading(
    'headerconfig',
    get_string('headerconfig', 'block_private_shares'),
    get_string('descconfig', 'block_private_shares')
));

$settings->add(new admin_setting_configcheckbox(
    'private_shares/show_header',
    get_string('labelshowheader', 'block_private_shares'),
    get_string('descshowheader', 'block_private_shares'),
    '0'
));
