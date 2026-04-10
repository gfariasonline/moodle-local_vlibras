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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Plugin admin settings.
 *
 * @package    local_vlibras
 * @copyright  2026 Thiago Serrao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage(
        'local_vlibras',
        get_string('pluginname', 'local_vlibras')
    );

    $settings->add(new admin_setting_configcheckbox(
        'local_vlibras/enabled',
        get_string('enabled', 'local_vlibras'),
        get_string('enabled_desc', 'local_vlibras'),
        0
    ));

    $settings->add(new admin_setting_configselect(
        'local_vlibras/position',
        get_string('position', 'local_vlibras'),
        get_string('position_desc', 'local_vlibras'),
        'R',
        [
            'TL' => get_string('position_tl', 'local_vlibras'),
            'T' => get_string('position_t', 'local_vlibras'),
            'TR' => get_string('position_tr', 'local_vlibras'),
            'R' => get_string('position_right', 'local_vlibras'),
            'BR' => get_string('position_br', 'local_vlibras'),
            'B' => get_string('position_b', 'local_vlibras'),
            'BL' => get_string('position_bl', 'local_vlibras'),
            'L' => get_string('position_left', 'local_vlibras'),
        ]
    ));

    $settings->add(new admin_setting_configselect(
        'local_vlibras/avatar',
        get_string('avatar', 'local_vlibras'),
        get_string('avatar_desc', 'local_vlibras'),
        'icaro',
        [
            'icaro' => get_string('avatar_icaro', 'local_vlibras'),
            'hosana' => get_string('avatar_hosana', 'local_vlibras'),
            'guga' => get_string('avatar_guga', 'local_vlibras'),
            'random' => get_string('avatar_random', 'local_vlibras'),
        ]
    ));

    $ADMIN->add('localplugins', $settings);
}
