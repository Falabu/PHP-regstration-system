<?php
require  'config/config.php';

$user = new UserController();

$user->setUserById(1);

$usr = $user->getUser();


echo $usr->getUEmail();
echo $usr->getUName();

echo var_dump($user);

echo errorLogger::getUserMessages();

