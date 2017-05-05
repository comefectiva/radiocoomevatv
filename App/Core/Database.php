<?php
namespace App\Core\Database;

//Database Driver
use PDO;

/**
 * Class Database
 * @package App\Core\Database
 */
class Database {

    private static $host = "127.0.0.1";
    private static $dbName = "radiocoomevatv";
    private static $user = "root";
    private static $pass = "Gaton123";

    //RadioCoomeva OLD
    private static $dbOld = 'radiocoomeva-old';

    /**
     * @return PDO Connection
     */
    private static function con() {
        $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";charset=utf8", self::$user, self::$pass);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    private static function Oldcon() {
        $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbOld.";charset=utf8", self::$user, self::$pass);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function save($query, $params = array()) {
        $pdo = self::con();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $pdo->lastInsertId();
    }

    public static function update($query, $params = array()) {
        $pdo = self::con();
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $params;
    }


    /**
     * @param $query = SQL Query
     * @param array $params = PARAMS for PDO
     * @return array with result list
     */
    public static function query($query, $params = array()) {
        $stmt = self::con()->prepare($query);
        $stmt->execute($params);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    /**
     * @param $query = SQL Query
     * @param array $params = PARAMS for PDO
     * @return array with one result
     */
    public static function getOne($query, $params = array()) {
        $stmt = self::con()->prepare($query);
        $stmt->execute($params);
        $data = $stmt->fetch();
        return $data;
    }

    /**
     * functions for old connection
     **/
    /**
     * @param $query = SQL Query
     * @param array $params = PARAMS for PDO
     * @return array with result list
     */
    public static function OldQuery($query, $params = array()) {
        $stmt = self::Oldcon()->prepare($query);
        $stmt->execute($params);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    /**
     * @param $query = SQL Query
     * @param array $params = PARAMS for PDO
     * @return array with one result
     */
    public static function OldGetOne($query, $params = array()) {
        $stmt = self::Oldcon()->prepare($query);
        $stmt->execute($params);
        $data = $stmt->fetch();
        return $data;
    }
}

