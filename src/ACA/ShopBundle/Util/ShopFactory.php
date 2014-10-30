<?php

namespace ACA\ShopBundle\DB;

/**
 * This class is responsible for instantiating objects for us
 * Class ShopFactory
 *
 * @package ACA\ShopBundle\Util
 */
class ShopFactory
{
    /**
     * Singleton instance for database connector object
     *
     * @var DBCommon
     */
    private static $DBCommonInstance;

    /**
     * Get some configuration properties we need
     *
     * @return array
     */
    public static function getConfig()
    {
        return array(
            'db_host' => 'aca.local',
            'db_user' => 'root',
            'db_pass' => 'something',
            'db_name' => 'acashop',
            'db_port' => 3306
        );
    }

    /**
     * Get an object that we can use to interact with the database
     * This is a classic singleton pattern, and it will ensure that we only have one instantiated object from this class per request cycle
     *
     * @return DBCommon
     */
    public static function getDB()
    {
        if (!isset(self::$DBCommonInstance)) {

            /** @var array $cfg Array of configuration data */
            $cfg = self::getConfig();

            self::$DBCommonInstance = new DBCommon($cfg['db_host'], $cfg['db_user'], $cfg['db_pass'], $cfg['db_name'], $cfg['db_port']);
        }
        return self::$DBCommonInstance;
    }
}