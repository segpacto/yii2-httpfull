<?php

namespace HttpFull;

/**
 * Bootstrap class that facilitates autoloading.  A naive
 * PSR-0 autoloader.
 *
 * @author Nate Good <me@nategood.com>
 */
class Bootstrap
{

    const DIR_GLUE = DIRECTORY_SEPARATOR;
    const NS_GLUE = '\\';

    public static $registered = false;

    /**
     * Register the autoloader and any other setup needed
     */
    public static function initialize()
    {
        spl_autoload_register(array('\Httpfull\Bootstrap', 'autoload'));
        self::registerHandlers();
    }

    /**
     * The autoload magic (PSR-0 style)
     *
     * @param string $classname
     */
    public static function autoload($classname)
    {
        self::_autoload(dirname(dirname(__FILE__)), $classname);
    }

    /**
     * Register the autoloader and any other setup needed
     */
    public static function pharInit()
    {
        spl_autoload_register(array('\Httpfull\Bootstrap', 'pharAutoload'));
        self::registerHandlers();
    }

    /**
     * Phar specific autoloader
     *
     * @param string $classname
     */
    public static function pharAutoload($classname)
    {
        self::_autoload('phar://httpful.phar', $classname);
    }

    /**
     * @param string $base
     * @param string $classname
     */
    private static function _autoload($base, $classname)
    {
        $parts      = explode(self::NS_GLUE, $classname);
        $path       = $base . self::DIR_GLUE . implode(self::DIR_GLUE, $parts) . '.php';

        if (file_exists($path)) {
            require_once($path);
        }
    }
    /**
     * Register default mime handlers.  Is idempotent.
     */
    public static function registerHandlers()
    {
        if (self::$registered === true) {
            return;
        }

        // @todo check a conf file to load from that instead of
        // hardcoding into the library?
        $handlers = array(
            \HttpFull\Mime::JSON => new \HttpFull\Handlers\JsonHandler(),
            \HttpFull\Mime::XML  => new \HttpFull\Handlers\XmlHandler(),
            \HttpFull\Mime::FORM => new \HttpFull\Handlers\FormHandler(),
            \HttpFull\Mime::CSV  => new \HttpFull\Handlers\CsvHandler(),
        );

        foreach ($handlers as $mime => $handler) {
            // Don't overwrite if the handler has already been registered
            if (Httpfull::hasParserRegistered($mime))
                continue;
            Httpfull::register($mime, $handler);
        }

        self::$registered = true;
    }
}
