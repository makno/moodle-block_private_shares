<?php

/**
 * Private Shares Block
 *
 * @package    block_private_shares
 * @copyright  Mathias Knoll <mathias.knoll@fh-joanneum.at>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_private_shares_edit_form extends block_edit_form {

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

        $mform->addElement('textarea', 'config_shares', get_string("csvfile", "block_private_shares"), 'wrap="none" rows="20" cols="50"');
        $mform->addHelpButton('config_shares', 'csvfile', 'block_private_shares');

    }
}