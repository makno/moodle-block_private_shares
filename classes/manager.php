<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License...
//
// @package    block_private_shares
// @copyright  2026 Mathias Knoll
// @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later


namespace block_private_shares;

defined('MOODLE_INTERNAL') || die();

use coding_exception;
use context_course;
use context_user;
use moodle_exception;
use required_capability_exception;
use stdClass;

class manager {

    const CAN_MANAGE = 'block/private_shares:addinstance';
    const CAN_VIEW = 'block/private_shares:view';

    protected $isenabled = null;
    protected $courseid = null;
    protected $context;
    protected static $instance;
    public $private_shares;

    public $title;


    protected function __construct($_private_shares) {
        $this->private_shares = $_private_shares;
        $this->courseid = intval($this->private_shares->page->course->id);
        $this->context = context_course::instance($this->courseid);
    }

    public function can_manage($userid = null) {
        return has_capability(self::CAN_MANAGE, $this->context, $userid);
    }

    public function can_view($userid = null) {
        return has_capability(self::CAN_VIEW, $this->context, $userid) || $this->can_manage();
    }

    public static function get($_private_shares, $forcereload = false) {
        global $CFG;
        if ($forcereload || !isset(self::$instance)) {
            self::$instance = new static($_private_shares);
        }
        return self::$instance;
    }

    public function get_context() {
        return $this->context;
    }

    public function require_manage($userid = null) {
        require_capability(self::CAN_MANAGE, $this->context, $userid);
    }

    public function require_view($userid = null) {
        if (!$this->can_view($userid)) {
            throw new required_capability_exception($this->get_context(), self::CAN_VIEW, 'nopermissions', '');
        }
    }


}