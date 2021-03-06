<?php
/**
 *Helper class for the UserController
 * Manages the database querys
 *
 */

namespace Model\User;
use Utils\dbConnect;

class UserDataManager implements UserDataManagerInterface
{
    private $db;

    /**
     * UserDataManager constructor. Creates a database connection
     */
    public function __construct()
    {
        $this->db = dbConnect::dbCon();
    }

    /**
     * Updates the users info where ID is the same
     *
     * @param User $user
     */
    public function updateUserInfo(User $user)
    {
        $sql = $this->db->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
        $sql->execute([$user->getUEmail(), $user->getUPassword(), $user->getUId()]);
    }

    /**
     * Uploading the new user to datbase
     *
     * @param User $user
     * @return bool
     */
    public function registerDB(User $user)
    {
        if ($this->checkIfUserExist($user)) {
            return false;
        }

        $sql = $this->db->prepare("INSERT INTO users(username, password, email) VALUES ( ? , ? , ? )");
        $sql->execute([$user->getUName(), $user->getUPassword(), $user->getUEmail()]);
        return true;
    }

    /**
     * Gets the users information from the database by Id
     *
     * @param $uId Int
     * @return array
     */
    public function getUserDataById($uId)
    {
        $sql = $this->db->prepare("SELECT username, email FROM users WHERE id = ? LIMIT 1");
        $sql->execute([$uId]);

        return $sql->fetchAll();
    }

    /**
     * If there is a row with a username and password the user autheticated
     *
     * @param $user User
     * @return boolean
     */
    public function loginDb(User $user)
    {
        $sql = $this->db->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
        $sql->execute([$user->getUName(),$user->getUPassword()]);
        $data = $sql->fetchColumn();

        if ($data == false) {
            return false;
        }
        $user->setUId($data);

        return true;
    }

    /**
     * It same like loginDB I need to change something here :D
     *
     * @param User $user
     * @return bool
     */
    private function checkIfUserExist(User $user)
    {
        $sql = $this->db->prepare("SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1");
        $sql->execute([$user->getUName(), $user->getUEmail()]);

        $data = $sql->fetchColumn();

        if ($data) {
            return true;
        }

        return false;
    }
}