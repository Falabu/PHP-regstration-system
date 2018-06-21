<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 13.
 * Time: 13:42
 */

namespace Utils;

class errorLogger
{
    private static $userMessages = array();
    private static $logFileName = LOG_URL . "log.txt";
    private static $msg = '';

    /**
     * Write the message to the $userMessages variable.
     *
     * @param $msg string Messages for the user
     */

    public static function writeUserMessages($msg)
    {
            self::$userMessages[] = $msg;
    }

    /**
     * Returns the messages that can the user see
     *
     * @return string
     */
    public static function getUserMessages()
    {
        foreach (self::$userMessages as $msg){
            self::$msg .= $msg . "<br>";
        }
        return self::$msg;
    }

    /**
     * Writes the errors into the log file for the developers
     *
     * @param $msg string Messages for the developers
     */

    public static function writeLog($msg){
        $date = date("Y.m.d H:i:s");

        if(!file_exists(self::$logFileName)) {
            fopen(LOG_URL . "log.txt", "w");
        }

        file_put_contents(self::$logFileName,$date." : ". $msg ."\r\n", FILE_APPEND);
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

}