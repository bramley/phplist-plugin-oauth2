<?php

require 'HTTP/Request2.php';

$tenantId = getConfig('oauth2_tenant_id');
$clientId = getConfig('oauth2_client_id');
$clientSecret = getConfig('oauth2_client_secret');
$redirectUri = getConfig('oauth2_client_redirect_url');

if (isset($_POST['refresh'])) {
    $tokenUri = sprintf('https://login.microsoftonline.com/%s/oauth2/v2.0/token', $tenantId);
    $postFields = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'redirect_uri' => $redirectUri,
        'grant_type' => 'refresh_token',
        'refresh_token' => getConfig('oauth2_refresh_token'),
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
            SaveConfig('oauth2_access_token', $auth['access_token']);
            SaveConfig('oauth2_expires_in', $auth['expires_in']);
            SaveConfig('oauth2_expires_at', time() + $auth['expires_in']);
            $result = 'Successfully refreshed access token';
        }
    } catch (Exception $exc) {
        $result = $exc->getMessage();
    }
    echo <<<END
<div class='note'>$result</div>
END;
}

$scopes = [
    'offline_access',
    'https://outlook.office.com/IMAP.AccessAsUser.All',
    'https://outlook.office.com/SMTP.Send',
    'openid',
    'email',
];
$query = http_build_query([
    'client_id' => $clientId,
    'scope' => implode(' ', $scopes),
    'redirect_uri' => $redirectUri,
    'response_type' => 'code id_token',
    'response_mode' => 'form_post',
    'approval_prompt' => 'auto',
    'prompt' => 'login',
    'nonce' => bin2hex(random_bytes(5)),
]);
$authUri = sprintf('https://login.microsoftonline.com/%s/oauth2/v2.0/authorize?', $tenantId) . $query;

$accessToken = getConfig('oauth2_access_token');
$authenticatedEmail = getConfig('oauth2_id_email');

if ($accessToken != '') {
    $expiresAt = date(DATE_RFC2822, getConfig('oauth2_expires_at'));
    echo <<<END
    Access token is<br>
    <pre> $accessToken</pre><br>
    Expires at $expiresAt<br>
    Associated with email address <code> $authenticatedEmail</code><br>
<form method="post">
    <input type="submit" name="refresh" value="Refresh access token">
</form>
END;
}
?>
<p>
    <center>
    <button onclick="window.location='<?=$authUri; ?>'">
        <img height="24" width="24" style="vertical-align:middle" src="/microsoft.svg" />
        Sign in with Microsoft to create a new access token
    </button>
    </center>
</p>
