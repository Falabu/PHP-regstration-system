<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 19.
 * Time: 13:21
 */

interface SessionAuthDataManagerInterface
{
    public function setSessionDb($uId, $hash);
    public function getSessionDb($uId, $hash);
    public function delSessionDb($uId);

}