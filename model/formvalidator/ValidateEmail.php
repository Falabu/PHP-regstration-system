<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 21.
 * Time: 16:00
 */

namespace Model\FormValidator;
use Utils\errorLogger;

class ValidateEmail implements BasicValidator
{
    private $regex = "/([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}/";

    public function validate($data)
    {
        if (isset($data) && $data != "") {
            if (preg_match($this->regex,$data)) {
                return true;
            }
            errorLogger::writeUserMessages("Nem jó az email formátuma");
            return false;
        }
        errorLogger::writeUserMessages("Nem adott meg értéket");
        return false;
    }

}