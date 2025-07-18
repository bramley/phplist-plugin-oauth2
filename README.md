# OAuth2 Plugin #

## Description ##

This plugin uses OAuth2 for authentication when retrieving bounces and sending emails.

## Installation ##

See the plugin's page within the phplist documentation site <https://resources.phplist.com/plugin/oauth2> for installation guidance.

## Usage ##

For guidance on using the plugin see <https://resources.phplist.com/plugin/oauth2>

## Support ##

Please raise any questions or problems in the user forum <https://discuss.phplist.org/>.

## Donation ##

This plugin is free but if you install and find it useful then a donation to support further development is greatly appreciated.

[![Donate](https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=W5GLX53WDM7T4)

## Version history ##

    version         Description
    1.7.1+20250716  Use processbounces.php from release 3.6.16
    1.7.0+20250707  Now Imap2 plugin must be installed separately
    1.6.2+20250526  Avoid php warning when $bounce_mailbox_user has not been set
    1.6.1+20250525  Use the token email address instead of the SMTP and bounce email addresses
    1.6.0+20240803  Refresh the token when necessary when sending emails using SMTP
    1.5.0+20240728  Support google using the league/oauth2-google package
    1.4.3+20240326  Handle exception when refreshing the access token, such as key expired
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
