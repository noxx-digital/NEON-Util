<?php

namespace Neon\Util;

use Exception;

abstract class Singleton
{
    /**
     * @var array
     */
    private static array $instances;

    /**
     *
     */
    final private function __construct()
    {
        self::$instances = [];
    }

    /**
     * @return mixed
     */
    final public static function get_instance(): mixed
    {
        $called_class = get_called_class();
        if ( !isset( self::$instances[$called_class] ))
            self::$instances[$called_class] = new $called_class();
        return self::$instances[$called_class];
    }

    /**
     * @return void
     */
    private function __clone() {}

    /**
     * prevent from being unserialized (which would create a second instance of it)
     *
     * @throws Exception
     */
    final public function __wakeup()
    {
        throw new Exception( "Cannot unserialize singleton" );
    }
}