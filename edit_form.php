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
 * Class for block form.
 *
 * @package    block_private_shares
 * @copyright  2026 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_private_shares_edit_form extends block_edit_form {
    /**
     * Form definition.
     * @param MoodleQuickForm $mform The form instance.
     * @return void
     */
    protected function specific_definition($mform) {

        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        $mform->addElement('text', 'config_title', get_string('blocktitle', 'block_private_shares'));
        $mform->setDefault('config_title', get_string('blocktitle_default', 'block_private_shares'));
        $mform->setType('config_title', PARAM_TEXT);
        $mform->addHelpButton('config_title', 'blocktitle', 'block_private_shares');
        $mform->addElement('text', 'config_text', get_string('blockstring', 'block_private_shares'));
        $mform->setType('config_text', PARAM_RAW);
        $mform->addHelpButton('config_text', 'blockstring', 'block_private_shares');
        $mform->addElement('text', 'config_filename', get_string('filename', 'block_private_shares'));
        $mform->setType('config_filename', PARAM_TEXT);
        $mform->addHelpButton('config_filename', 'filename', 'block_private_shares');
        $mform->addElement(
            'textarea',
            'config_shares',
            get_string("csvfile", "block_private_shares"),
            'wrap="none" rows="20" cols="50"'
        );
        $mform->addHelpButton('config_shares', 'csvfile', 'block_private_shares');
    }
}
