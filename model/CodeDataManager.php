<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 13.
 * Time: 15:03
 */

class CodeDataManager
{
    private $db;

    public function __construct()
    {
        $this->db = dbConnect::dbCon();
    }

    public function upload($uId, $code){
        $sql = $this->db->prepare("INSERT INTO codes(code, uId) VALUES (?,?)");
        $sql->execute([$code,$uId]);
    }

    public function get($uId){
        $codes = array();
        $sql = $this->db->prepare("SELECT code FROM codes WHERE uId= ? ");
        $sql->execute([$uId]);
        $row = $sql->fetchAll();

        foreach ($row as $key){
            $codes[] = $key['code'];
        }

        return $codes;
    }
}