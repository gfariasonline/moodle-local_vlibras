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

use core\hook\output\before_footer_html_generation;

/**
 * Tests for hook_callbacks.
 *
 * @package    local_vlibras
 * @copyright  2026 Thiago Serrao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers \local_vlibras\hook_callbacks
 */
final class hook_callbacks_test extends \advanced_testcase {
    /**
     * Returns a hook instance backed by a mock renderer.
     *
     * @return before_footer_html_generation
     */
    private function make_hook(): before_footer_html_generation {
        $renderer = $this->getMockBuilder(\renderer_base::class)
            ->disableOriginalConstructor()
            ->getMock();
        return new before_footer_html_generation($renderer);
    }

    /**
     * When the plugin is disabled, no HTML is added to the footer.
     */
    public function test_disabled_adds_no_html(): void {
        $this->resetAfterTest();
        set_config('enabled', 0, 'local_vlibras');

        $hook = $this->make_hook();
        hook_callbacks::before_footer_html_generation($hook);

        $this->assertSame('', $hook->get_output());
    }

    /**
     * When the plugin is enabled, VLibras widget HTML is added to the footer.
     */
    public function test_enabled_adds_vlibras_html(): void {
        $this->resetAfterTest();
        set_config('enabled', 1, 'local_vlibras');
        set_config('position', 'R', 'local_vlibras');
        set_config('avatar', 'icaro', 'local_vlibras');

        $hook = $this->make_hook();
        hook_callbacks::before_footer_html_generation($hook);

        $output = $hook->get_output();
        $this->assertStringContainsString('<div vw class="enabled">', $output);
        $this->assertStringContainsString('vlibras-plugin.js', $output);
        $this->assertStringContainsString('vw-access-button', $output);
        $this->assertStringContainsString('VLibras.Widget', $output);
        $this->assertStringContainsString('vw-plugin-wrapper', $output);
        $this->assertStringContainsString('https://vlibras.gov.br/app/vlibras-plugin.js', $output);
        $this->assertStringContainsString('rootPath: "https://vlibras.gov.br/app"', $output);
        $this->assertStringContainsString('position: "R"', $output);
        $this->assertStringContainsString('avatar: "icaro"', $output);
    }

    /**
     * Configured widget options are injected into the footer output.
     */
    public function test_enabled_uses_configured_widget_options(): void {
        $this->resetAfterTest();
        set_config('enabled', 1, 'local_vlibras');
        set_config('position', 'TL', 'local_vlibras');
        set_config('avatar', 'random', 'local_vlibras');

        $hook = $this->make_hook();
        hook_callbacks::before_footer_html_generation($hook);

        $output = $hook->get_output();
        $this->assertStringContainsString('position: "TL"', $output);
        $this->assertStringContainsString('avatar: "random"', $output);
    }

    /**
     * Default state (no config set) must not inject HTML.
     */
    public function test_default_state_adds_no_html(): void {
        $this->resetAfterTest();
        // Do not set config — plugin default is disabled (0).

        $hook = $this->make_hook();
        hook_callbacks::before_footer_html_generation($hook);

        $this->assertSame('', $hook->get_output());
    }

    /**
     * Toggling from enabled back to disabled removes the HTML.
     */
    public function test_toggling_disabled_removes_html(): void {
        $this->resetAfterTest();
        set_config('enabled', 1, 'local_vlibras');

        $hook = $this->make_hook();
        hook_callbacks::before_footer_html_generation($hook);
        $this->assertNotSame('', $hook->get_output());

        // Now disable and verify a fresh hook produces no output.
        set_config('enabled', 0, 'local_vlibras');
        $hook2 = $this->make_hook();
        hook_callbacks::before_footer_html_generation($hook2);
        $this->assertSame('', $hook2->get_output());
    }
}
