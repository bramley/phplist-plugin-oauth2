<?php

use phpList\plugin\Common\PageURL;
use phpList\plugin\OAuth2\OAuthProvider;

$accessToken = OAuthProvider::getAccessTokenFromConfig();

if ($accessToken !== null) {
    $expiresAt = date(DATE_RFC2822, $accessToken->getExpires());
    $authenticatedEmail = getConfig('oauth2_id_email');
    $refreshUrl = new PageURL('authorise', ['pi' => $_GET['pi'], 'refresh' => 1]);
    echo <<<END
    Access token is<br>
    <pre> $accessToken</pre><br>
    Expires at $expiresAt<br>
    Associated with email address <code> $authenticatedEmail</code><br>
<form method="post" action="$refreshUrl">
    <input type="submit" name="refresh" value="Refresh access token">
</form>
END;
}
$authoriseUrl = new PageURL('authorise', ['pi' => $_GET['pi']]);
?>
<p>
    <center>
    <button onclick="window.location='<?= $authoriseUrl; ?>'">
        Create a new access token
    </button>
    </center>
</p>
