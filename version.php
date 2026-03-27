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

$plugin->component = 'block_private_shares';
$plugin->version = 2026032600;  // YYYYMMDDHH Moodle 4.5 where it runs tested
$plugin->requires = 2022041900; // YYYYMMDDHH Moodle 4.0+ (actually works with older ones too)
$plugin->maturity = MATURITY_STABLE;
$plugin->release = "1.0.0"   
