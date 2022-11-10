# OAuth2 Plugin #

## Description ##

This plugin uses OAuth2 for authentication when retrieving bounces and sending emails.

## Installation ##

### Dependencies ###

It requires the Common Plugin to be installed. You must install, or upgrade to, the latest version. See <https://github.com/bramley/phplist-plugin-common>

### Install through phplist ###

The recommended way to install is through the Plugins page (menu Config > Manage Plugins) using the package
URL `https://github.com/bramley/phplist-plugin-oauth2/archive/master.zip`.
The installation should create

* the file OAuth2.php
* the directory OAuth2

## Usage ##

For guidance on using the plugin see the plugin's page within the phplist documentation site <https://resources.phplist.com/plugin/oauth2>

## Support ##

Please raise any questions or problems in the user forum <https://discuss.phplist.org/>.

## Donation ##

This plugin is free but if you install and find it useful then a donation to support further development is greatly appreciated.

[![Donate](https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=W5GLX53WDM7T4)

## Version history ##

    version         Description
    1.1.1+20221110  Add configuration setting to control using OAuth2 when sending emails
    1.1.0+20221109  Use OAuth2 with phpmailer
    1.0.0+20221108  Initial version