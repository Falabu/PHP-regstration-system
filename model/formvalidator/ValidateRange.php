<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 21.
 * Time: 16:01
 */

namespace Model\FormValidator;


use Utils\errorLogger;

class ValidateRange implements BasicValidator
{
    private $from;
    private $to;

    public function __construct($from, $to){
     $this->from = $from;
     $this->to = $to;
    }

    public function validate($data)
    {
        if(isset($data) && is_int($data)){
            if($data <= $this->to && $data >= $this->from){
                return true;
            }
            errorLogger::writeUserMessages("Az érték határon kívül esik");
            return false;
        }

        errorLogger::writeUserMessages("Nincs érték megadva");
        return false;
    }
}