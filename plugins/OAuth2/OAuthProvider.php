<?php

namespace phpList\plugin\OAuth2;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use phpList\plugin\Common\Logger;

class OAuthProvider implements \PHPMailer\PHPMailer\OAuthTokenProvider
{
    /**
     * Factory method to create a provider.
     *
     * @return League\OAuth2\Client\Provider\AbstractProvider
     */
    public static function getProvider()
    {
        $logger = Logger::instance();
        $stack = HandlerStack::create();
        $stack->push(Middleware::log($logger, new MessageFormatter('Response {code} {res_body}'), 'debug'));
        $stack->push(Middleware::log($logger, new MessageFormatter('Request {method} {uri} {req_body}'), 'debug'));

        $collaborators = ['httpClient' => new Client(['handler' => $stack])];
        $options = [
            'clientId' => getConfig('oauth2_client_id'),
            'clientSecret' => getConfig('oauth2_client_secret'),
            'redirectUri' => getConfig('oauth2_client_redirect_url'),
        ];
        $provider = self::AzureProvider($options, $collaborators);

        return $provider;
    }

    /**
     * Get the access token from the config table.
     *
     * @return League\OAuth2\Client\Token\AccessToken|null
     */
    public static function getAccessTokenFromConfig()
    {
        $jsonAccessToken = getConfig('oauth2_access_token_json');

        return $jsonAccessToken === ''
            ? null
            : new \League\OAuth2\Client\Token\AccessToken(json_decode($jsonAccessToken, true));
    }

    /**
     * Save the access token in the config table.
     */
    public static function saveAccessTokenInConfig($accessToken)
    {
        SaveConfig('oauth2_access_token_json', json_encode($accessToken));
    }

    /**
     * Called by phpmailer to get the bearer token.
     *
     * @return string
     */
    public function getOauth64()
    {
        global $bounce_mailbox_user;

        $user = $bounce_mailbox_user;
        $accessToken = self::getAccessTokenFromConfig();
        $auth = base64_encode("user=$user\001auth=Bearer $accessToken\001\001");

        return $auth;
    }

    /**
     * Creates an OAuth2 provider for Azure.
     *
     * @return TheNetworg\OAuth2\Client\Provider\Azure
     */
    private static function AzureProvider($options, $collaborators)
    {
        $options['scopes'] = [
            'offline_access',
            'https://outlook.office.com/IMAP.AccessAsUser.All',
            'https://outlook.office.com/SMTP.Send',
            'openid',
            'email',
        ];
        $options['defaultEndPointVersion'] = '2.0';
        $provider = new \TheNetworg\OAuth2\Client\Provider\Azure($options, $collaborators);
        $provider->tenant = getConfig('oauth2_tenant_id');

        return $provider;
    }
}
