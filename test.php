<?php
/*require 'config/config.php';
*/
define('LOG_URL',$_SERVER['DOCUMENT_ROOT'] . "/Vizsga/log/");

require 'model\Request.php';
require 'utils\errorLogger.php';
require 'model\formvalidator\ValidatorInterface.php';
require 'model\formvalidator\FormValidator.php';
require 'model\formvalidator\ValidateEqual.php';
require 'model\formvalidator\ValidateEmail.php';
require 'model\formvalidator\ValidateLenght.php';
require 'model\UrlBuilder.php';

use \Model\Request;
use \Model\FormValidator\FormValidator;
use \Model\FormValidator\ValidateEmail;
use \Model\FormValidator\ValidateEqual;
use \Model\FormValidator\ValidateLenght;
use \Model\UrlBuilder;

$url = new UrlBuilder();
$request = new Request();
$validator = new FormValidator();
$validator2 = new FormValidator();
$lenght = new ValidateLenght(10);

$tomb = array();

if($request->isPost() && $request->getString('submit') == 'submit'){
    $email = new ValidateEmail();
    $equal = new ValidateEqual($request->getString('elso'));
    $validator->addValidator($email);
    $validator2->addValidator($equal);
    $validator2->addValidator($lenght);

    if($validator->validate($request->getString('email')) &&
        $validator2->validate($request->getString('masodik'))){
        $params = array('eggyik' => $request->getString('email'), 'harmadik' => $request->getString('masodik'));
        $url->addParam($params);

        echo "Minden fasza! <br>";
        echo $url;
    }

}

echo \Utils\errorLogger::getUserMessages();
?>

<html>
<head>
    <title>Ez</title>
</head>
<body>
<form method="post">
    <input type="text" name="email">
    <input type="text" name="elso">
    <input type="text" name="masodik">
    <input type="submit" name="submit" value="submit">
</form>
</body>
</html>


