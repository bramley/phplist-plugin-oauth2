<?php
/**
 * OAuth2 for phplist.
 *
 * This file is a part of OAuth2 plugin.
 *
 * @category  phplist
 *
 * @author    Duncan Cameron
 * @copyright 2022 Duncan Cameron
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License, Version 3
 */

/**
 * Registers the plugin with phplist.
 */
class OAuth2 extends phplistPlugin
{
    const VERSION_FILE = 'version.txt';

    /*
     *  Inherited variables
     */
    public $name = 'OAuth2';
    public $authors = 'Duncan Cameron';
    public $description = 'Use OAuth2 for authentication';
    public $documentationUrl = 'https://resources.phplist.com/plugin/oauth2';
    public $commandlinePluginPages = ['processbouncesoauth2'];
    public $remotePages = ['processbouncesoauth2'];

    public function __construct()
    {
        global $public_scheme, $website, $adminpages;

        $redirectUrl = sprintf('%s://%s%s/?pi=%s&page=%s', $public_scheme, getConfig('website'), $adminpages, __CLASS__, 'authorise');

        $this->settings = array(
            'oauth2_tenant_id' => [
                'description' => s('Tenant ID'),
                'type' => 'text',
                'value' => '',
                'allowempty' => false,
                'category' => 'OAuth2',
            ],
            'oauth2_client_id' => [
                'description' => s('Client ID'),
                'type' => 'text',
                'value' => '',
                'allowempty' => false,
                'category' => 'OAuth2',
            ],
            'oauth2_client_secret' => [
                'description' => s('Client secret value'),
                'type' => 'text',
                'value' => '',
                'allowempty' => false,
                'category' => 'OAuth2',
            ],
            'oauth2_client_redirect_url' => [
                'description' => s('Redirect URL'),
                'type' => 'text',
                'value' => $redirectUrl,
                'allowempty' => false,
                'category' => 'OAuth2',
            ],
            'oauth2_use_for_sending' => [
                'description' => s('Use OAuth2 for authentication when sending emails with SMTP'),
                'type' => 'boolean',
                'value' => false,
                'allowempty' => true,
                'category' => 'OAuth2',
            ],
            'oauth2_imap_max_bounces' => [
                'description' => s('Maximum number of bounce emails to process'),
                'type' => 'integer',
                'value' => 1000,
                'allowempty' => false,
                'max' => 20000,
                'category' => 'OAuth2',
            ],
            'oauth2_rules_batch_size' => [
                'description' => s('Batch size for processing bounce rules'),
                'type' => 'integer',
                'value' => 100,
                'allowempty' => false,
                'max' => 1000,
                'category' => 'OAuth2',
            ],
            'oauth2_imap_mailbox' => [
                'description' => s('IMAP Mailbox/folder, such as INBOX'),
                'type' => 'text',
                'value' => 'INBOX',
                'allowempty' => false,
                'category' => 'OAuth2',
            ],
        );
        $this->topMenuLinks = [
            'token' => ['category' => 'system'],
        ];
        $this->pageTitles = [
            'token' => 'OAuth2 access token',
        ];

        if (MANUALLY_PROCESS_BOUNCES) {
            $this->topMenuLinks['processbouncesoauth2'] = ['category' => 'system'];
            $this->pageTitles['processbouncesoauth2'] = 'Process bounces using OAuth2';
        }

        $this->coderoot = dirname(__FILE__) . '/' . __CLASS__ . '/';
        $this->version = file_get_contents($this->coderoot . self::VERSION_FILE);

        parent::__construct();
    }

    public function adminmenu()
    {
        return $this->pageTitles;
    }

    /**
     * Provide the dependencies for enabling this plugin.
     *
     * @return array
     */
    public function dependencyCheck()
    {
        return [
            'Common Plugin enabled' => phpListPlugin::isEnabled('CommonPlugin'),
            'phpList version 3.6.10 or later' => version_compare(VERSION, '3.6.10') >= 0,
        ];
    }

    /**
     * Use this hook to set phpmailer to use oauth2.
     *
     * @return array
     */
    public function messageHeaders($mail)
    {
        if (getConfig('oauth2_use_for_sending')) {
            $mail->AuthType = 'XOAUTH2';
            $mail->setOAuth(new phpList\plugin\OAuth2\OAuthProvider());
        }

        return [];
    }
}
