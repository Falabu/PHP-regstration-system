<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 21.
 * Time: 21:18
 */

namespace model\formvalidator;


use Utils\errorLogger;

class ValidateLenght implements BasicValidator
{
    private $lenght;

    public function __construct($lenght)
    {
        $this->lenght = $lenght;
    }

    public function validate($data)
    {
        if(isset($data) && is_string($data)){
            if(mb_strlen($data) >= $this->lenght){
                return true;
            }

            errorLogger::writeUserMessages("Hosszabnak kell lennie a karakterláncnak");
            return false;
        }

        errorLogger::writeUserMessages("Nincs érték megadva");
        return false;
    }
}