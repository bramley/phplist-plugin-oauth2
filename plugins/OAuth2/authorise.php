<?php

use phpList\plugin\Common\PageURL;
use phpList\plugin\OAuth2\OAuthProvider;

$provider = OAuthProvider::getProvider();

if (isset($_POST['refresh'])) {
    $accessToken = OAuthProvider::getAccessTokenFromConfig();
    $newAccessToken = $provider->getAccessToken(
        'refresh_token',
        ['refresh_token' => $accessToken->getRefreshToken()]
    );
    OAuthProvider::saveAccessTokenInConfig($newAccessToken);
    header('Location: ' . new PageURL('token', ['pi' => $_GET['pi']]));

    exit;
}

if (!isset($_GET['code'])) {
    $authorizationUrl = $provider->getAuthorizationUrl();
    $_SESSION['OAuth2.state'] = $provider->getState();
    header('Location: ' . $authorizationUrl);

    exit;
}

if (empty($_GET['state']) || (isset($_SESSION['oauth2state']) && $_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['OAuth2.state']);
    echo 'Invalid state';

    return;
}

try {
    $accessToken = $provider->getAccessToken(
        'authorization_code',
        ['code' => $_GET['code']]
    );
    OAuthProvider::saveAccessTokenInConfig($accessToken);

    $resourceOwner = $provider->getResourceOwner($accessToken);
    SaveConfig('oauth2_id_email', $resourceOwner->claim('email'));
    header('Location: ' . new PageURL('token', ['pi' => $_GET['pi']]));

    exit;
} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    exit($e->getMessage());
} catch (\Exception $e) {
    exit($e->getMessage());
}
