<?php

namespace phpList\plugin\OAuth2;

class OAuthProvider implements \PHPMailer\PHPMailer\OAuthTokenProvider
{
    /**
     * Factory method to create a provider.
     *
     * @return League\OAuth2\Client\Provider\AbstractProvider
     */
    public static function getProvider()
    {
        return self::AzureProvider();
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
        $serializedAccessToken = getConfig('oauth2_access_token_object');
        $accessToken = unserialize(base64_decode($serializedAccessToken), ['allowed_classes' => true]);
        $auth = base64_encode("user=$user\001auth=Bearer $accessToken\001\001");

        return $auth;
    }

    /**
     * Creates an OAuth2 provider for Azure.
     *
     * @return TheNetworg\OAuth2\Client\Provider\Azure
     */
    private static function AzureProvider()
    {
        $scopes = [
            'offline_access',
            'https://outlook.office.com/IMAP.AccessAsUser.All',
            'https://outlook.office.com/SMTP.Send',
            'openid',
            'email',
        ];
        $provider = new \TheNetworg\OAuth2\Client\Provider\Azure([
            'clientId' => getConfig('oauth2_client_id'),
            'clientSecret' => getConfig('oauth2_client_secret'),
            'redirectUri' => getConfig('oauth2_client_redirect_url'),
            'scopes' => $scopes,
            'defaultEndPointVersion' => '2.0',
        ]);

        return $provider;
    }
}
