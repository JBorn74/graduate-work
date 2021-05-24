<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc6c8633ceb6885e493facc75335b3f08
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/models',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc6c8633ceb6885e493facc75335b3f08::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc6c8633ceb6885e493facc75335b3f08::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc6c8633ceb6885e493facc75335b3f08::$classMap;

        }, null, ClassLoader::class);
    }
}