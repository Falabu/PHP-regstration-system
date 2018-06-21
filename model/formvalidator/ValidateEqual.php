<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 21.
 * Time: 16:00
 */

namespace Model\FormValidator;


use Utils\errorLogger;

class ValidateEqual implements ValidatorInterface
{
    private $token;
    private $error;

    public function __construct($token)
    {
        if(isset($token)){
            $this->token = strtolower($token);
        }else{
            $this->error = "Nincsen érték megadva";
        }
    }

    public function validate($data)
    {
        if(isset($data) && $data != ''){
            if($this->token === strtolower($data)){
                return true;
            }
            errorLogger::writeUserMessages("nem egyeznek az értékek");
            return false;
        }

        errorLogger::writeUserMessages("Adjon meg értéket");
        return false;
    }
}