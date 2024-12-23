<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9b92bac2df048f1bbc6574e12b23abad
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TECWEB\\MYAPI\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TECWEB\\MYAPI\\' => 
        array (
            0 => __DIR__ . '/../..' . '/myapi',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9b92bac2df048f1bbc6574e12b23abad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9b92bac2df048f1bbc6574e12b23abad::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9b92bac2df048f1bbc6574e12b23abad::$classMap;

        }, null, ClassLoader::class);
    }
}
