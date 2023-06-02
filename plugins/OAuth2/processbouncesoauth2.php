<?php

namespace phpList\plugin\OAuth2;

function imap_base64($string)
{
    return imap2_base64($string);
}

function imap_body($imap, $messageNum, $flags = 0)
{
    return imap2_body($imap, $messageNum, $flags);
}

function imap_close($imap, $flags = 0)
{
    return imap2_close($imap, $flags);
}

function imap_headerinfo($imap, $messageNum, $fromLength = 0, $subjectLength = 0, $defaultHost = null)
{
    return imap2_headerinfo($imap, $messageNum, $fromLength, $subjectLength, $defaultHost);
}

function imap_delete($imap, $messageNums, $flags = 0)
{
    return imap2_delete($imap, $messageNums, $flags);
}

function imap_fetchheader($imap, $messageNum, $flags = 0)
{
    return imap2_fetchheader($imap, $messageNum, $flags);
}

function imap_last_error()
{
    return imap2_last_error();
}

function imap_num_msg($imap)
{
    return imap2_num_msg($imap);
}

function imap_open($mailbox, $user, $password, $flags = 0, $retries = 0, $options = [])
{
    return imap2_open($mailbox, $user, $password, $flags | OP_XOAUTH2, $retries, $options);
}

function imap_qprint($string)
{
    return imap2_qprint($string);
}

$accessToken = OAuthProvider::getAccessTokenFromConfig();

if ($accessToken === null) {
    $message = 'OAuth2 access token is required';
    echo $message;

    return;
}
$provider = OAuthProvider::getProvider();
$newAccessToken = $provider->getAccessToken(
    'refresh_token',
    ['refresh_token' => $accessToken->getRefreshToken()]
);
OAuthProvider::saveAccessTokenInConfig($newAccessToken);

$bounce_mailbox_password = $newAccessToken->getToken();

require __DIR__ . '/processbounces.php';
