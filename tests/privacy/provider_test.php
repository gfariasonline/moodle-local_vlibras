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

namespace local_vlibras\privacy;

use core_privacy\local\metadata\collection;
use core_privacy\tests\provider_testcase;

/**
 * Privacy provider tests for local_vlibras.
 *
 * @package    local_vlibras
 * @category   test
 * @copyright  2026 Thiago Serrao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers     \local_vlibras\privacy\provider
 */
final class provider_test extends provider_testcase {
    /**
     * The plugin must describe the external VLibras service in metadata.
     */
    public function test_get_metadata(): void {
        $collection = new collection('local_vlibras');
        $metadata = provider::get_metadata($collection);

        $this->assertSame($collection, $metadata);
        $items = $metadata->get_collection();
        $this->assertCount(1, $items);
        $this->assertSame('vlibras', $items[0]->get_name());
        $this->assertSame('privacy:metadata:vlibras', $items[0]->get_summary());

        $fields = $items[0]->get_privacy_fields();
        $this->assertArrayHasKey('data', $fields);
        $this->assertSame('privacy:metadata:vlibras:data', $fields['data']);
    }
}
