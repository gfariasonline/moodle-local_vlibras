# VLibras local plugin for Moodle

`local_vlibras` enables administrators to turn the official VLibras accessibility widget on or off for the whole Moodle site.

## Features

- Adds a single site-wide admin setting to enable or disable the VLibras widget.
- Injects the official VLibras widget snippet into the page footer using Moodle core hooks.
- Avoids editing the `additionalhtmlfooter` setting manually.

## Requirements

- Moodle 4.5 or later within the supported 4.5 branch.
- Internet access to load the public VLibras JavaScript asset from `https://vlibras.gov.br/app/vlibras-plugin.js`.

## Installation

1. Copy the plugin into `local/vlibras`.
2. Visit `Site administration > Notifications` to complete the installation.
3. Go to `Site administration > Plugins > Local plugins > VLibras`.
4. Enable the `Enable VLibras widget` setting.

## Behaviour

When enabled, the plugin injects the official VLibras widget markup on every Moodle page that renders a footer. This matches the typical manual setup performed through `additionalhtmlfooter`, but keeps the configuration isolated inside the plugin.

## Privacy

The plugin does not store personal data in Moodle. When enabled, it loads the public VLibras widget from an external service and page content is processed by that service so the accessibility translation can be rendered.

## Development checks

Run the recommended checks from the Moodle root:

```bash
php vendor/bin/phpunit --testsuite local_vlibras_testsuite
~/Sites/moodle-plugin-ci/bin/moodle-plugin-ci phpcs /Users/thiagoserrao/Sites/moodle45/local/vlibras
~/Sites/moodle-plugin-ci/bin/moodle-plugin-ci phpmd -m /Users/thiagoserrao/Sites/moodle45 /Users/thiagoserrao/Sites/moodle45/local/vlibras
```
