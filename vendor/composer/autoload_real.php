<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit4356468c3c2edb04b2911f3e44a5ed19
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

        spl_autoload_register(array('ComposerAutoloaderInit4356468c3c2edb04b2911f3e44a5ed19', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit4356468c3c2edb04b2911f3e44a5ed19', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit4356468c3c2edb04b2911f3e44a5ed19::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
