# Changelog

All notable changes to this plugin will be documented in this file.

## 1.1.1

- Fixed the position setting to offer only Left and Right, as supported by the current official widget.
- Migrated legacy Top left and Bottom left settings to Left, and other unsupported positions to Right.
- Restricted widget initialisation to supported positions and added regression tests.
- Updated the language strings and documentation to clarify that the button is centred vertically.

## 1.1.0

- Added administrator settings to choose the VLibras widget position and avatar.
- Expanded the position setting to support all official VLibras placement options.
- Updated the injected VLibras widget initialisation to pass `rootPath`, `position`, and `avatar`.
- Added PHPUnit coverage for the configurable widget options.
- Updated the plugin documentation to describe the new configuration options.

## 1.0.1

- Initial public release of the `local_vlibras` plugin for Moodle 4.5 and later.
- Added a site-level setting to enable or disable the VLibras widget.
- Injected the official VLibras widget using Moodle output hooks.
- Implemented the Privacy API metadata for the external VLibras service.
