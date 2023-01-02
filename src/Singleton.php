<?php

namespace Neon\Util;

use Exception;

abstract class Singleton
{
    /**
     * @var array
     */
    private static array $instances = [];

    /**
     *
     */
    final private function __construct()
    {

    }

    /**
     * @return mixed
     */
    final public static function get_instance(): mixed
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
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