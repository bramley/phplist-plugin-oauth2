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
    $mailbox = str_replace('INBOX', getConfig('oauth2_imap_mailbox'), $mailbox);

    return imap2_open($mailbox, $user, $password, $flags | OP_XOAUTH2, $retries, $options);
}

function imap_qprint($string)
{
    return imap2_qprint($string);
}

$accessToken = getConfig('oauth2_access_token');

if ($accessToken == '') {
    $message = 'OAuth2 access token is required';
    echo $message;

    return;
}
$expiresAt = getConfig('oauth2_expires_at');

if ($expiresAt < time()) {
    $message = sprintf('OAuth2 access token expired at %s', date(DATE_RFC2822, $expiresAt));
    logEvent($message);
    echo $message;

    return;
}

$bounce_mailbox_password = $accessToken;

require __DIR__ . '/processbounces.php';
