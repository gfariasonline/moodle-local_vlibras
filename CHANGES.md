# Changelog

All notable changes to this plugin will be documented in this file.

## Unreleased

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
