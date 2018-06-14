<?php
//Import

require 'utils/errorLogger.php';
require 'database/DbConnect.php';
require 'model/Password.php';
require 'model/User.php';
require 'model/Code.php';
require 'model/CodeDataManager.php';
require 'model/SessionAuth.php';
require 'model/SessionAuthDataManager.php';
require 'controller/UserDataManager.php';
require 'controller/UserController.php';

define('DB_NAME','vizsga');
define('DB_UNAME','root');
define('DB_PASSWORD','');
define('DB_HOST','localhost');


define('LOG_URL',$_SERVER['DOCUMENT_ROOT'] . "/Vizsga/log/");

