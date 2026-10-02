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

namespace local_vlibras;

/**
 * Tests for legacy widget position upgrades.
 *
 * @package    local_vlibras
 * @copyright  2026 Thiago Serrao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers ::xmldb_local_vlibras_upgrade
 */
final class upgrade_test extends \advanced_testcase {
    /**
     * Upgrade all legacy positions without changing unrelated settings.
     */
    public function test_legacy_positions_are_migrated(): void {
        global $CFG;
        require_once($CFG->libdir . '/upgradelib.php');
        require_once($CFG->dirroot . '/local/vlibras/db/upgrade.php');
        $this->resetAfterTest();
        set_config('enabled', 0, 'local_vlibras');
        set_config('avatar', 'random', 'local_vlibras');

        $positions = ['TL' => 'L', 'BL' => 'L', 'T' => 'R', 'TR' => 'R',
            'BR' => 'R', 'B' => 'R', 'L' => 'L', 'R' => 'R', 'invalid' => 'R'];
        foreach ($positions as $oldposition => $expected) {
            set_config('version', 2026041000, 'local_vlibras');
            set_config('position', $oldposition, 'local_vlibras');
            $this->assertTrue(xmldb_local_vlibras_upgrade(2026041000));
            $this->assertSame($expected, get_config('local_vlibras', 'position'), $oldposition);
            $this->assertSame('0', get_config('local_vlibras', 'enabled'));
            $this->assertSame('random', get_config('local_vlibras', 'avatar'));
        }
    }

    /**
     * An unset position remains unset, using the normal widget default.
     */
    public function test_unset_position_remains_unset(): void {
        global $CFG;
        require_once($CFG->libdir . '/upgradelib.php');
        require_once($CFG->dirroot . '/local/vlibras/db/upgrade.php');
        $this->resetAfterTest();
        set_config('version', 2026041000, 'local_vlibras');
        unset_config('position', 'local_vlibras');

        $this->assertTrue(xmldb_local_vlibras_upgrade(2026041000));
        $this->assertFalse(get_config('local_vlibras', 'position'));
    }
}
