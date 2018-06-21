<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 21.
 * Time: 14:36
 */

namespace Model\FormValidator;

interface ValidatorInterface
{
    public function validate($data);
}