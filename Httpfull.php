<?php

namespace HttpFull;

// install Composer autoloader

//require(__DIR__ . '/../vendor/autoload.php');

// include Yii class file
//require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

class Httpfull
{
    const VERSION = '0.2.19';

    private static $mimeRegistrar = array();
    private static $default = null;

    /**
     * @param string $mimeType
     * @param \Httpfull\Handlers\MimeHandlerAdapter $handler
     */
    public static function register($mimeType, \HttpFull\Handlers\MimeHandlerAdapter $handler)
    {
        self::$mimeRegistrar[$mimeType] = $handler;
    }

    /**
     * @param string $mimeType defaults to MimeHandlerAdapter
     * @return \Httpfull\Handlers\MimeHandlerAdapter
     */
    public static function get($mimeType = null)
    {
        if (isset(self::$mimeRegistrar[$mimeType])) {
            return self::$mimeRegistrar[$mimeType];
        }

        if (empty(self::$default)) {
            self::$default = new \HttpFull\Handlers\MimeHandlerAdapter();
        }

        return self::$default;
    }

    /**
     * Does this particular Mime Type have a parser registered
     * for it?
     * @param string $mimeType
     * @return bool
     */
    public static function hasParserRegistered($mimeType)
    {
        return isset(self::$mimeRegistrar[$mimeType]);
    }

    public static function run()
    {
        echo "asldkjalkdjsalk";
    }
}
