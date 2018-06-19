<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 19.
 * Time: 13:31
 */

interface UserDataManagerInterface
{
    public function updateUserInfo(User $user);

    public function registerDB(User $user);

    public function getUserDataById($uId);

    public function loginDb(User $user);
}