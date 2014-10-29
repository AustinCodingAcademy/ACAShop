<?php

namespace ACA\ShopBundle\Util;

use \Exception as Exception;

/**
 * Class DBCommon contains functionality for us to interact with the database
 *
 * @package ACA\ShopBundle\Util
 */
class DBCommon
{
    /**
     * mysqli connection object
     *
     * @var resource
     */
    private $mysqli;

    /**
     * @param string $host     What server is the database located on?
     * @param string $user     What is the DB user
     * @param string $pass     What is her password
     * @param string $database What is the name of the database that we want to query
     * @param int    $port     What port should we connect to
     *
     * @throws Exception
     */
    public function __construct($host, $user, $pass, $database, $port = 3306)
    {
        $this->mysqli = new \mysqli($host, $user, $pass, $database, $port);

        if ($this->mysqli->connect_errno) {
            throw new Exception("Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error);
        }
    }
}