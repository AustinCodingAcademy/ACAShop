<?php
namespace ACA\ShopBundle\Util;

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
            'db_host' => 'localhost',
            'db_user' => 'root',
            'db_pass' => 'root', // No database password needed on VM
            'db_name' => 'acashop',
            'db_port' => 8889
        );
    }

    /**
     * Get an object that we can use to interact with the database
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
    }
}