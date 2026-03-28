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
//
// @package    block_private_shares
// @copyright  2026 Mathias Knoll
// @license    https://www.gnu.org/licenses/agpl-3.0.html GNU AFFERO GENERAL PUBLIC LICENSE Version 3, 19 November 2007.

namespace block_private_shares;

use coding_exception;
use context_course;
use context_user;
use moodle_exception;
use required_capability_exception;
use stdClass;

/**
 * Block that handles private shares.
 *
 * @package    block_private_shares
 * @copyright  2026 Mathias Knoll
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class manager {
    /**
     *  Capability to add to instance.
     */
    const CAN_MANAGE = 'block/private_shares:addinstance';
    /**
     *  Visibility.
     */
    const CAN_VIEW = 'block/private_shares:view';
    /**
     *  If block is enabled.
     * @var $isenabled
     */
    protected $isenabled = null;
    /**
     *  Id of course.
     * @var $courseid
     */
    protected $courseid = null;
    /**
     *  Context.
     * @var $context
     */
    protected $context;
    /**
     *  Current instance.
     * @var $instance
     */
    protected static $instance;
    /**
     * Block object.
     * @var $privateshares
     */
    public $privateshares;
    /**
     * Title of block.
     * @var $title
     */
    public $title;

    /**
     * Constructor with block object.
     * @param block_private_shares $privateshares The private shares block instance.
     */
    protected function __construct($privateshares) {
        $this->privateshares = $privateshares;
        $this->courseid = intval($this->privateshares->page->course->id);
        $this->context = context_course::instance($this->courseid);
    }

    /**
     * Capabilities check.
     * @param $userid
     * @return mixed
     */
    public function can_manage($userid = null) {
        return has_capability(self::CAN_MANAGE, $this->context, $userid);
    }

    /**
     * Check on view capability.
     * @param int|null $userid The user ID to check, or null for the current user.
     * @return bool True if the user can view, false otherwise.
     */
    public function can_view($userid = null) {
        return has_capability(self::CAN_VIEW, $this->context, $userid) || $this->can_manage();
    }

    /**
     * Get instance.
     * @param block_private_shares $privateshares The private shares block instance.
     * @param bool $forcereload Whether to force reloading the instance.
     * @return static The singleton instance.
     */
    public static function get($privateshares, $forcereload = false) {
        global $CFG;
        if ($forcereload || !isset(self::$instance)) {
            self::$instance = new static($privateshares);
        }
        return self::$instance;
    }
    /**
     * Get context.
     * @return mixed
     */
    public function get_context() {
        return $this->context;
    }
    /**
     * Capabilities Requirement "manage".
     * @param int|null $userid The user ID to check, or null for the current user.
     * @return void
     * @throws required_capability_exception If the user does not have the capability.
     */
    public function require_manage($userid = null) {
        require_capability(self::CAN_MANAGE, $this->context, $userid);
    }
    /**
     * Capabilities Requirement "view".
     * @param int|null $userid The user ID to check, or null for the current user.
     * @return void
     * @throws required_capability_exception If the user does not have the capability.
     */
    public function require_view($userid = null) {
        if (!$this->can_view($userid)) {
            throw new required_capability_exception($this->get_context(), self::CAN_VIEW, 'nopermissions', '');
        }
    }
}
