# VLibras for Moodle

`local_vlibras` adds administrator settings to enable or disable the official VLibras widget across the whole Moodle site, and to choose the initial widget position and avatar.

The plugin provides the same practical result as manually adding the VLibras snippet to `additionalhtmlfooter`, but keeps the configuration inside the plugin and uses Moodle core hooks to inject the widget in the page footer.

## Compatibility

- Moodle 4.5 or later
- Tested in CI with Moodle 4.5, 5.0 and 5.1
- Internet access to load the official VLibras script from `https://vlibras.gov.br/app/vlibras-plugin.js`

## What the plugin does

- Adds site-level settings to enable or disable VLibras
- Lets administrators choose the initial widget position
- Lets administrators choose the initial widget avatar
- Injects the official VLibras widget markup in pages that render a footer
- Avoids manual changes to the Moodle `additionalhtmlfooter` setting

## Installation

1. Place the plugin in `local/vlibras`.
2. Log in as an administrator.
3. Open `Site administration > Notifications` to complete installation.

## Configuration

1. Go to `Site administration > Plugins > Local plugins > VLibras`.
2. Enable `Enable VLibras widget`.
3. Choose the initial widget position: `Top left`, `Top`, `Top right`, `Right`, `Bottom right`, `Bottom`, `Bottom left`, or `Left`.
4. Choose the initial avatar: `Icaro`, `Hosana`, `Guga`, or `Random`.

Once enabled, the widget is loaded site-wide on pages that render the Moodle footer using the configured position and avatar.

## External service

This plugin depends on the public VLibras service maintained outside Moodle. When the setting is enabled, Moodle loads the VLibras JavaScript widget from the official public endpoint.

Official VLibras installation reference:
- [VLibras widget integration guide](https://vlibras.gov.br/doc/widget/installation/webpageintegration.html)

## Privacy

The plugin does not store personal data in Moodle. When enabled, page content may be processed by the external VLibras service so that the accessibility translation can be rendered.
