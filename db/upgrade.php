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
 * Upgrade steps for local_vlibras.
 *
 * @package    local_vlibras
 * @copyright  2026 Thiago Serrao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Migrate legacy positions to the sides supported by the official widget.
 *
 * @param int $oldversion Previously installed plugin version.
 * @return bool
 */
function xmldb_local_vlibras_upgrade($oldversion) {
    if ($oldversion < 2026100200) {
        $position = get_config('local_vlibras', 'position');
        if ($position !== false && !in_array($position, ['L', 'R'], true)) {
            $position = in_array($position, ['TL', 'BL'], true) ? 'L' : 'R';
            set_config('position', $position, 'local_vlibras');
        }

        upgrade_plugin_savepoint(true, 2026100200, 'local', 'vlibras');
    }

    return true;
}
