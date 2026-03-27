<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License...
//
// @package    block_private_shares
// @copyright  2026 Mathias Knoll
// @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later

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