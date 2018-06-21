<?php
//require 'config/config.php';
define('LOG_URL',$_SERVER['DOCUMENT_ROOT'] . "/Vizsga/log/");
require 'utils/errorLogger.php';
require 'model/formvalidator/BasicValidator.php';
require 'model/formvalidator/ValidateEmail.php';
require 'model/formvalidator/ValidateRange.php';
require 'model/formvalidator/ValidateEqual.php';
require 'model/formvalidator/ValidatePassword.php';
require 'model/formvalidator/FormValidator.php';
require 'model/formvalidator/ValidateLenght.php';

$valid3 = new \Model\FormValidator\ValidateLenght(10);
$valid2 = new \model\formvalidator\ValidateEmail();
$valid = new \Model\FormValidator\FormValidator();

$valid->addValidator($valid2);
$valid->addValidator($valid3);
$jelszo = "md@ffffffffssss.hu";

if($valid->validate($jelszo)){
    echo "minden jő";
}


$tomb = \Utils\errorLogger::getUserMessages();

echo $tomb;

