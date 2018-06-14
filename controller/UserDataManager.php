<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 13.
 * Time: 18:41
 */

class UserDataManager
{
    private $db;


    public function __construct()
    {
        $this->db = dbConnect::dbCon();
    }


    public function updateUserInfo(User $user)
    {
        $sql = $this->db->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
        $sql->execute([$user->getUEmail(), $user->getUPassword(), $user->getUId()]);
    }

    public function registerDB(User $user)
    {
        if ($this->checkIfUserExist($user) == true) {
            return false;
        } else {
            $sql = $this->db->prepare("INSERT INTO users(username, password, email) VALUES ( ? , ? , ? )");
            $sql->execute([$user->getUName(), $user->getUPassword(), $user->getUEmail()]);
            return true;
        }
    }

    public function getUserDataById($uId)
    {
        $sql = $this->db->prepare("SELECT username, email FROM users WHERE id = ?");
        $sql->execute([$uId]);

        return $sql->fetchAll();
    }

    public function loginDb(User $user)
    {
        $sql = $this->db->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
        $sql->execute([$user->getUName(), $user->getUPassword()]);

        if ($sql->rowCount() == 1) {
            $user->setUId($sql->fetchColumn());
            return true;
        } else {
            return false;
        }
    }

    private function checkIfUserExist(User $user)
    {
        $sql = $this->db->prepare("SELECT id FROM users WHERE username = ? AND email = ?");
        $sql->execute([$user->getUName(), $user->getUEmail()]);
        $data = $sql->fetchAll();

        if ($data) {
            return true;
        } else {

            return false;
        }
    }
}