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
 * Hook callbacks for local_vlibras.
 *
 * @package    local_vlibras
 * @copyright  2026 Thiago Serrao
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class hook_callbacks {
    /**
     * Inject the VLibras widget HTML into the page footer when the plugin is enabled.
     *
     * @param before_footer_html_generation $hook
     */
    public static function before_footer_html_generation(before_footer_html_generation $hook): void {
        if (during_initial_install()) {
            return;
        }

        if (!get_config('local_vlibras', 'enabled')) {
            return;
        }

        $html  = '<div vw class="enabled">' . "\n";
        $html .= '    <div vw-access-button class="active"></div>' . "\n";
        $html .= '    <div vw-plugin-wrapper>' . "\n";
        $html .= '        <div class="vw-plugin-top-wrapper"></div>' . "\n";
        $html .= '    </div>' . "\n";
        $html .= '</div>' . "\n";
        $html .= '<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>' . "\n";
        $html .= '<script>new window.VLibras.Widget(\'https://vlibras.gov.br/app\');</script>' . "\n";

        $hook->add_html($html);
    }
}
