<?php
/**
 * Class SessionAuth
 *
 * Creates, manages the authentication across the whole application, it uses the SessionAuthDataManager for
 * database querys.
 */

class SessionAuth
{
    private $sessionHash;
    private $uId;
    private $sessionDb;

    public function __construct()
    {
        session_start();
        $this->sessionDb = new SessionAuthDataManager();
    }

    /**
     * Creates the authentication by setting the $_SESSION global variable, and checks if somewhere else the user is
     * logged in by verifying there is no other same session in the database. If the user's session is in the database
     * and other login attempt happens it's logs out the user and delete the session.
     *
     * @param $uID int THe logged in user's ID
     */
    public function setSession($uID)
    {
        $this->uId = $uID;
        $this->sessionHash = $this->createSessionHash();

        if ($this->checkLogin()) {
            $this->delSession();
            errorLogger::writeUserMessages("Már van ilyen felhasználó bejelentkezve! Ezért kiléptettük a felhasználót");
        } else {
            $_SESSION['login'] = true;
            $_SESSION['hash'] = $this->sessionHash;
            $_SESSION['id'] = $this->uId;
            $this->sessionDb->setSessionDb($this->uId, $this->sessionHash);
        }
    }

    /**
     * Delete the $_SESSION and delete the session in the database, logging out the user.
     *
     * @return bool
     */
    public function delSession()
    {
        if ($this->sessionDb->delSessionDb($_SESSION['id'])) {
            unset($_SESSION['login']);
            unset($_SESSION['hash']);
            unset($_SESSION['id']);
            return true;
        } else {
            errorLogger::writeUserMessages("Nem sikerült kiléptetni a felhasználót");
            return false;
        }
    }

    /**
     * Creates a unique session hash for vertification
     *
     * @return string
     */
    private function createSessionHash()
    {
        $date = date("Y:m:d H:i:S");
        return md5($this->uId . $date);
    }

    /**
     *
     * Checks if the user is logged in by verifying the $_SESSION array an if its equal with the database session the
     * user is logged in.
     *
     * @return bool
     */
    public function checkLogin()
    {
        if (isset($_SESSION['login']) && isset($_SESSION['id']) && isset($_SESSION['hash'])) {
            if ($_SESSION['login'] == "true") {
                if ($this->sessionDb->getSessionDb($_SESSION['id'], $_SESSION['hash'])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            $_SESSION['login'] = false;
            return false;
        }
    }
}