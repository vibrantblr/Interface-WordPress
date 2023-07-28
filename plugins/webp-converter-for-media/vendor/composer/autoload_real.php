<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitffe2d8364e5cb5e284fe0f59671985ae
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitffe2d8364e5cb5e284fe0f59671985ae', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitffe2d8364e5cb5e284fe0f59671985ae', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitffe2d8364e5cb5e284fe0f59671985ae::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
