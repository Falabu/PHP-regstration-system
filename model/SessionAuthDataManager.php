<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 13.
 * Time: 16:23
 */

class SessionAuthDataManager
{
    private $db;

    public function __construct()
    {
        $this->db = dbConnect::dbCon();
    }

    public function setSessionDb($uId,$hash){
        $sql = $this->db->prepare("INSERT INTO session(session, uId) VALUES (?,?)");
        $sql->execute([$hash,$uId]);
    }

    public function getSessionDb($uId,$hash){
        $sql = $this->db->prepare("SELECT id FROM session WHERE uId = ? AND session = ?");
        if($sql->execute([$uId,$hash])){
            return true;
        }else{
            return false;
        }
    }

    public function delSessionDb($uId){
        $sql = $this->db->prepare("DELETE FROM session WHERE uId = ?");
        if($sql->execute([$uId])){
            return true;
        }else{
            return false;
        }
    }
}