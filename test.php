<?php
require  'config/config.php';

$userDbManager = new UserDataManager();
$password = new Password();
$authData = new SessionAuthDataManager();
$auth = new SessionAuth($authData);

$userManager = new UserController($userDbManager,$password);



$userManager->createUserLogin("falabu","bercike");

$userManager->login($auth);

echo $auth->checkLogin() . "<br>";

echo var_dump($_SESSION). "<br>";

echo errorLogger::getUserMessages();

