<?php

require 'HTTP/Request2.php';

$tenantId = getConfig('oauth2_tenant_id');
$clientId = getConfig('oauth2_client_id');
$clientSecret = getConfig('oauth2_client_secret');
$redirectUri = getConfig('oauth2_client_redirect_url');

if (isset($_REQUEST['code'])) {
    if (isset($_REQUEST['error'])) {
        echo 'Authorization server returned an error: ' . htmlspecialchars($_GET['error']);

        return;
    }
    list($headb64, $bodyb64, $cryptob64) = explode('.', $_REQUEST['id_token']);
    $body = json_decode(base64_decode(strtr($bodyb64, '-_', '+/')));
    $email = $body->email;
    SaveConfig('oauth2_id_email', $email);

    $tokenUri = sprintf('https://login.microsoftonline.com/%s/oauth2/v2.0/token', $tenantId);
    $postFields = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'redirect_uri' => $redirectUri,
        'code' => $_REQUEST['code'],
        'grant_type' => 'authorization_code',
    ];

    try {
        $request = new HTTP_Request2($tokenUri, HTTP_Request2::METHOD_POST);
        $request->addPostParameter($postFields);
        $response = $request->send()->getBody();

        if (null === ($auth = json_decode($response, true))) {
            $result = 'json_decode failed';
        } elseif (isset($auth['error'])) {
            $result = $auth['error'];
        } else {
            SaveConfig('oauth2_json', $response);
            SaveConfig('oauth2_access_token', $auth['access_token']);
            SaveConfig('oauth2_refresh_token', $auth['refresh_token']);
            SaveConfig('oauth2_token_type', $auth['token_type']);
            SaveConfig('oauth2_scope', $auth['scope']);
            SaveConfig('oauth2_expires_in', $auth['expires_in']);
            SaveConfig('oauth2_expires_at', time() + $auth['expires_in']);
            $result = 'Successfully obtained access token';
        }
    } catch (Exception $exc) {
        $result = $exc->getMessage();
    }
    header(sprintf('Location: %s?result=%s', $redirectUri, $result));

    exit();
}

if (isset($_GET['result'])) {
    $result = urldecode($_GET['result']);
    echo <<<END
<title>OAuth2</title>
{$pagedata['header']}
<div class='note'>$result</div>
<a href="./admin/">Login to phpList</a>
$PoweredBy
{$pagedata['footer']}
END;
}
