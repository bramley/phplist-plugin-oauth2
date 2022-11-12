<?php

use phpList\plugin\Common\PageURL;
use phpList\plugin\OAuth2\OAuthProvider;

$provider = OAuthProvider::getProvider();

if (isset($_POST['refresh'])) {
    $serializedAccessToken = getConfig('oauth2_access_token_object');
    $accessToken = unserialize(base64_decode($serializedAccessToken), ['allowed_classes' => true]);
    $newAccessToken = $provider->getAccessToken(
        'refresh_token',
        ['refresh_token' => $accessToken->getRefreshToken()]
    );
    SaveConfig('oauth2_access_token_object', base64_encode(serialize($newAccessToken)));
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
    SaveConfig('oauth2_access_token_object', base64_encode(serialize($accessToken)));

    $resourceOwner = $provider->getResourceOwner($accessToken);
    SaveConfig('oauth2_id_email', $resourceOwner->claim('email'));
    header('Location: ' . new PageURL('token', ['pi' => $_GET['pi']]));

    exit;
} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    exit($e->getMessage());
} catch (\Exception $e) {
    exit($e->getMessage());
}
