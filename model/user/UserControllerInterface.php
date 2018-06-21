<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 19.
 * Time: 14:06
 */

namespace Model\User;
use Model\Session\SessionAuthInterface;

interface UserControllerInterface
{
    public function getUser();

    public function setUserById($uId);

    public function updateUserData();

    public function register($name, $email, $pass1, $pass2);

    public function login(SessionAuthInterface $auth,$name,$pass);

    public function logout(SessionAuthInterface $auth);
}