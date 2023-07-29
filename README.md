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
    1.4.2+20231019  Use config.php settings added to phplist 3.6.14 instead of plugin's settings
    1.4.1+20230602  Allow more than one mailbox to be specified and processed
    1.4.0+20230523  Display process bounces with OAuth2 menu only when MANUALLY_PROCESS_BOUNCES is enabled
    1.3.2+20230520  Derive the redirect URL
    1.3.1+20221119  Log request and response messages
    1.3.0+20221115  Refresh the access token when processing bounces
    1.2.2+20221113  Set tenant property on the provider
    1.2.1+20221113  Improve error handling
    1.2.0+20221113  Use the PHP League OAuth2 client package
    1.1.3+20221110  Allow IMAP mailbox/folder to be configurable
                    Run processbouncesoauth2 page as a remote page
    1.1.2+20221110  Remove Psr/Container package so that the version included with Common Plugin will be used
    1.1.1+20221110  Add configuration setting to control using OAuth2 when sending emails
    1.1.0+20221109  Use OAuth2 with phpmailer
    1.0.0+20221108  Initial version
