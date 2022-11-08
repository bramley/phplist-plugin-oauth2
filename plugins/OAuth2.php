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
    public $commandlinePluginPages = ['processbounces'];
    public $topMenuLinks = [
        'processbouncesoauth2' => ['category' => 'system'],
        'authenticate' => ['category' => 'system'],
    ];
    public $pageTitles = [
        'processbouncesoauth2' => 'Process bounces using OAuth2',
        'authenticate' => 'Authenticate using OAuth2',
    ];
    public $publicPages = ['authcallback'];

    public function __construct()
    {
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
                'value' => '',
                'allowempty' => false,
                'category' => 'OAuth2',
            ],
        );
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
        ];
    }
}
