<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbf53eac01490a8bb2135efd4dae92556
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'def43f6c87e4f8dfd0c9e1b1bab14fe8' => __DIR__ . '/..' . '/symfony/polyfill-iconv/bootstrap.php',
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        '9b59d1b0dc9f17a96044da689a464ead' => __DIR__ . '/..' . '/javanile/php-imap2/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'ZBateson\\StreamDecorators\\' => 26,
            'ZBateson\\MbWrapper\\' => 19,
            'ZBateson\\MailMimeParser\\' => 24,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Iconv\\' => 23,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Container\\' => 14,
        ),
        'J' => 
        array (
            'Javanile\\Imap2\\' => 15,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ZBateson\\StreamDecorators\\' => 
        array (
            0 => __DIR__ . '/..' . '/zbateson/stream-decorators/src',
        ),
        'ZBateson\\MbWrapper\\' => 
        array (
            0 => __DIR__ . '/..' . '/zbateson/mb-wrapper/src',
        ),
        'ZBateson\\MailMimeParser\\' => 
        array (
            0 => __DIR__ . '/..' . '/zbateson/mail-mime-parser/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Iconv\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-iconv',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
            1 => __DIR__ . '/..' . '/psr/http-factory/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Javanile\\Imap2\\' => 
        array (
            0 => __DIR__ . '/..' . '/javanile/php-imap2/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbf53eac01490a8bb2135efd4dae92556::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbf53eac01490a8bb2135efd4dae92556::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitbf53eac01490a8bb2135efd4dae92556::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitbf53eac01490a8bb2135efd4dae92556::$classMap;

        }, null, ClassLoader::class);
    }
}
