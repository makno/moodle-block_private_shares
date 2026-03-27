<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * English Language.
 * @package    block_private_shares
 * @copyright  2026 Mathias Knoll
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['pluginname'] = 'Private Shares';
$string['private_shares'] = 'Private Shares';
$string['greenpass:addinstance'] = 'Add a new private shares block';
$string['greenpass:myaddinstance'] = 'Add a new private shares block to the My Moodle page';

$string['blocksettings'] = 'Additional settings';

$string['headerconfig'] = 'Configuration';
$string['descconfig'] = 'Additional configuration';

$string['labelshowheader'] = 'Show header ';
$string['descshowheader'] = 'Show header of block';

$string['blocktitle'] = 'Block title';
$string['blocktitle_help'] = 'Title of block';
$string['blocktitle_default'] = 'Private Share';

$string['blockstring'] = 'Block text';
$string['blockstring_help'] = 'Description of provided data!';

$string['filename'] = 'Filename';
$string['filename_help'] = 'Data will be provided as a downloadable file for students. If this field is left empy, the data will be shown as text. Attention for all too long texts!';

$string['csvfile'] = 'Share config file (CSV formatted text)';
$string['csvfile_help'] = 'Format: "username","base64 encoded content"';

$string['error_number_fields'] = 'Error (L{$a->line}): Wrong amount of fields!';
$string['error_user_not_existing'] = 'Error (L{$a->line}): {$a->username} does not existing!';
$string['error_no_base64'] = 'Error (L{$a->line}): No BASE64 encoding!';
$string['error_no_usershare'] = 'No data has been related to you! Please contact your teacher!';
