<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 19.
 * Time: 13:29
 */

interface SessionAuthInterface
{
    public function setSession($uID);

    public function delSession();

    public function checkLogin();
}