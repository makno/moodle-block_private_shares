<?php

/**
 * Private Shares Block
 *
 * @package    block_private_shares
 * @copyright  Mathias Knoll <mathias.knoll@fh-joanneum.at>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'block_private_shares';
$plugin->version = 2026032600;  // YYYYMMDDHH Moodle 4.5 where it runs tested
$plugin->requires = 2022041900; // YYYYMMDDHH Moodle 4.0+ (actually works with older ones too)
$plugin->maturity = MATURITY_STABLE;
$plugin->release = "1.0.0"   
