<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 19.
 * Time: 13:25
 */

interface PasswordInterface
{
    public function createPassword($pwd1, $pwd2);

    public function hashPassword($pwd);

    public function getPassword();
}