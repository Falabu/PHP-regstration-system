<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 20.
 * Time: 7:19
 */

namespace Model\FormValidator;

class FormValidator
{
    private $validators = array();
    private $error;


    public function addValidator(BasicValidator $validator)
    {
        $this->validators[] = $validator;
    }

    public function validate($data)
    {
        foreach ($this->validators as $validator) {
            $this->error = $validator->validate($data);
        }
        if($this->error == false){
            return false;
        }

        return true;
    }
}