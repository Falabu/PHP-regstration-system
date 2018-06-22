<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 22.
 * Time: 6:09
 */

namespace model;


class Request
{
    private $data;
    private $method;

    public function __construct()
    {
        $this->data = array_merge($_GET, $_POST);
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function getString($name)
    {
        return (string)filter_var($this->data[$name], FILTER_SANITIZE_STRING);
    }

    public function getInt($name){
        return (int)filter_var($this->data[$name], FILTER_SANITIZE_NUMBER_INT);
    }

    public function isPost(){
         if($this->method == 'POST'){
             return true;
         }
    }

    public function isGet(){
        if($this->method == 'GET'){
            return true;
        }
    }
}