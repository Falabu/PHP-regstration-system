<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 19.
 * Time: 13:15
 */

namespace Model;

interface CodeDataManagerInterface
{
    public function upload($uId, $code);
    public function get($uId);
}