<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License...
//
// @package    block_private_shares
// @copyright  2026 Mathias Knoll
// @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later

namespace block_private_shares\output;

defined('MOODLE_INTERNAL') || die();

use context;
use html_writer;
use moodle_url;
use plugin_renderer_base;
use renderable;
use tabobject;

class renderer extends plugin_renderer_base {
    public function render_page_main_content(renderable $page) {
        $data = $page->export_for_template($this);
        return parent::render_from_template('block_private_shares/main_content', $data);
    }
}