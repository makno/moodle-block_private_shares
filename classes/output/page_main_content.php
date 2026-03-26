<?php

/**
 * Private Shares Block
 *
 * @package    block_private_shares
 * @copyright  Mathias Knoll <mathias.knoll@fh-joanneum.at>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_private_shares\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use renderer_base;
use templatable;
use moodle_url;

class page_main_content implements renderable, templatable {

    protected $manager;

    protected $userid;

    public function __construct($manager, $userid = null) {
        $this->manager = $manager;
        $this->userid = $userid;
    }

    public function export_for_template(renderer_base $output) {
        global $DB, $USER;
        $data = array();
        $data['img_logo'] =  $output->image_url('logo', 'block_private_shares');
        $data['title'] = $this->manager->private_shares->title;
        $data['hastext'] = !empty($this->manager->private_shares->text);
        $data['text'] = $this->manager->private_shares->text;
        $data['shares'] = $this->manager->private_shares->shares;
        $data['usershare'] = $this->manager->private_shares->usershare;
        $data['isteacher'] = $this->manager->private_shares->isteacher;
        $data['hasfilename'] = $this->manager->private_shares->hasfilename;
        $data['filename'] = $this->manager->private_shares->filename;
        $data['error_usershare'] = get_string('error_no_usershare','block_private_shares');

        return $data;
    }


}