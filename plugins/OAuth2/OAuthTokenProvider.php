<?php

namespace phpList\plugin\OAuth2;

class OAuthTokenProvider implements \PHPMailer\PHPMailer\OAuthTokenProvider
{
    public function getOauth64()
    {
        global $bounce_mailbox_user;

        $user = $bounce_mailbox_user;
        $accessToken = getConfig('oauth2_access_token');
        $auth = base64_encode("user=$user\001auth=Bearer $accessToken\001\001");

        return $auth;
    }
}
