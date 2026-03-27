<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License...
//
// @package    block_private_shares
// @copyright  2026 Mathias Knoll
// @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later

/**
 * Block that handles private shares.
 *
 * @package    block_private_shares
 * @copyright  2026 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_private_shares extends block_base {
    // Shared content
    public $hasfilename = false;
    public $filename = '';
    public $usershare = [];
    public $shares = [];
    public $text = '';
    public $isteacher = false;

    public function init() {
        $this->title = get_string('pluginname', 'block_private_shares');
    }

    function has_config() {
        return true;
    }

    public function instance_allow_config() {
        return false;
    }

    public function instance_allow_multiple() {
        return false;
    }

    public function cron() {
        mtrace( "Hey, my cron script is running" );
        // do something
        return true;
    }

    public function hide_header() {
        return false;
    }

    public function applicable_formats() {
        return array(
            'all' => false,
            'site' => false,
            'site-index' => false,
            'course-view' => true,
            'course-view-social' => false,
            'mod' => false,
            'mod-quiz' => false
        );
    }


    public function get_content() {
        global $CFG, $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        $this->content          = new stdClass;
        $this->content->items   = array();
        $this->content->icons   = array();
        $this->content->text    = '';
        $this->content->footer  = '';

        $manager = \block_private_shares\manager::get($this);

        $renderer = $this->page->get_renderer('block_private_shares');
        $page = new \block_private_shares\output\page_main_content($manager);

        $this->content->text = $renderer->render($page);

        return $this->content;
    }

    public function specialization() {
        global $DB, $USER, $COURSE;

        if (isset($this->config)) {
            if (!empty($this->config->title)) {
                $this->title = $this->config->title;
            }

            if (!empty($this->config->text)) {
                $this->text = $this->config->text;
            }

            if (!empty($this->config->filename)){
                $this->hasfilename = true;
                $this->filename = $this->config->filename;
            }

            if (!empty($this->config->shares)) {
                // Get current user
                $user = $DB->get_record('user', array('id'=>$USER->id));
                $username = $user->username;
                // Get context
                $context = context_course::instance($COURSE->id);
                // Get rolename of current user
                $roles = get_user_roles($context, $USER->id, true);
                $role = key($roles);
                $rolename = $roles[$role]->shortname;
                if($rolename == "editingteacher" || $rolename == "teacher" ) {
                    $this->isteacher = true;
                }
                // Check shares file
                $size = 2;
                $countlines = 1;
                foreach(preg_split('/((\r?\n)|(\r\n?))/', $this->config->shares) as $line) {
                    $linearray = preg_split('/,/', $line);
                    $l = [];
                    $l['serror'] = false;
                    $l['serrortext'] = '';

                    if (count($linearray) == $size) {
                        // Field 1 Username
                        if($user = $DB->get_record('user', array('username'=>$linearray[0]))) {
                            $l['sname']= $linearray[0];
                        }else{
                            $l['serror'] = true;
                            $prm = new stdClass(); $prm->line = $countlines; $prm->username = $linearray[0];
                            $l['serrortext'] = get_string('error_user_not_existing','block_private_shares', $prm);
                            $this->shares[] = $l;
                        }
                        // Field 2 Base64 Code
                        $str = base64_decode($linearray[1], true);
                        if ($str === false) {
                            $l['serror'] = true;
                            $prm = new stdClass(); $prm->line = $countlines;
                            $l['serrortext'] = get_string('error_no_base64','block_private_shares', $prm);
                            $this->shares[] = $l;
                        }else {
                            $l['stextbase64'] = $linearray[1];
                            $l['stext'] = $str;
                            if(strlen($str)>100){
                                $l['stextshort'] = substr($str,0,50) . ' ... ' . substr($str,strlen($str)-50);
                            }else{
                                $l['stextshort'] = $str;
                            }
                        }
                    }else{
                        $l['serror'] = true;
                        $prm = new stdClass(); $prm->line = $countlines;
                        $l['serrortext'] = get_string('error_number_fields','block_private_shares',$prm);
                        $this->shares[] = $l;
                    }
                    if(array_key_exists('sname',$l) && $l['sname']===$username){
                        $this->usershare[] = $l;
                    }
                    if($l['serror']==false){
                        $this->shares[] = $l;
                    }
                    $countlines++;
                }
            }
        }
    }

    public function instance_config_save($data, $nolongerused = false) {
        if(get_config('private_shares', 'how_header') == '1') {
            $data->text = strip_tags($data->text);
        }

        // And now forward to the default implementation defined in the parent class
        return parent::instance_config_save($data,$nolongerused);
    }

    public function html_attributes() {
        $attributes = parent::html_attributes(); // Get default values
        $attributes['class'] .= ' block_'. $this->name(); // Append our class to class attribute
        return $attributes;
    }



}