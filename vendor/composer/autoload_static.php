<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0e77002729cfc759287d89d8b5622436
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'GPH\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'GPH\\' => 
        array (
            0 => __DIR__ . '/..' . '/giphy/giphy-php-client/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0e77002729cfc759287d89d8b5622436::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0e77002729cfc759287d89d8b5622436::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}