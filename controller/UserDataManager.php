<?php
/**
 *Helper class for the UserController
 * Manages the database querys
 *
 */

class UserDataManager
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
        if ($this->checkIfUserExist($user) == true) {
            return false;
        } else {
            $sql = $this->db->prepare("INSERT INTO users(username, password, email) VALUES ( ? , ? , ? )");
            $sql->execute([$user->getUName(), $user->getUPassword(), $user->getUEmail()]);
            return true;
        }
    }
    /**
     * Gets the users information from the database by Id
     *
     */
    public function getUserDataById($uId)
    {
        $sql = $this->db->prepare("SELECT username, email FROM users WHERE id = ?");
        $sql->execute([$uId]);

        return $sql->fetchAll();
    }
    /**
     * If there is a row with a username and password the user autheticated
     *
     */
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

    /**
     * It same like loginDB I need to change something here :D
     *
     * @param User $user
     * @return bool
     */
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