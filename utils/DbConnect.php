<?php
/**
 * Class dbConnect
 *
 * Létrehoz egy kapcsolatot az adatbázishoz.
 *
 */

namespace Utils;
use PDO;
use PDOException;

class dbConnect
{
    static private $db = NULL;

    static private $dbName = DB_NAME;
    static private $dbUser = DB_UNAME;
    static private $dbPassword = DB_PASSWORD;
    static private $dbHost = DB_HOST;
    static private $dns;

    static private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    /**
     * Visszaadja a létrehozott adatbáziskapcsolatot az esetleges hibákat egy külön osztályba tárolja.
     *
     * @return null|PDO Visszadja PDO objektumot
     */
    static public function dbCon()
    {
        self::$dns = "mysql:dbname=" . self::$dbName . ";host=" . self::$dbHost;

        if (self::$db == NULL) {
            try {
                self::$db = new PDO(self::$dns,self::$dbUser,self::$dbPassword,self::$options);
            } catch (PDOException $e) {
                errorLogger::writeLog($e->getMessage());
                die("Nem sikerült kapcsolódni az adatbázishoz!");
            }
            return self::$db;
        } else {
            return self::$db;
        }



    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}