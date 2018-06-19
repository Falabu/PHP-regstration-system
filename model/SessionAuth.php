<?php
/**
 * Class SessionAuth
 * @uses SessionAuthDataManager
 *
 * Creates, deletes, manages the authentication, it uses the SessionAuthDataManager for
 * database query's.
 *
 * Copyright (C) 2018 by Kurucz Dávid
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author Kurucz Dávid
 *
 *
 * @param $sessionHash string
 * @param $uId int
 * @param $sessionDb SessionAuthDataManager
 */

class SessionAuth implements SessionAuthInterface
{
    private $sessionHash;
    private $uId;
    private $sessionDb;

    public function __construct(SessionAuthDataManagerInterface $sessionDb)
    {
        session_start();
        $this->sessionDb = $sessionDb;
    }

    /**
     * Creates the authentication by setting the $_SESSION global variable, and checks if somewhere else the user is
     * logged in by verifying there is no other same session in the database. If the user's session is in the database
     * and other login attempt happens it's logs out the user and delete the session.
     *
     * @param $uID int THe logged in user's ID
     * @return boolean
     */
    public function setSession($uID)
    {
        $this->uId = $uID;
        $this->sessionHash = $this->createSessionHash();

        if ($this->checkLogin()) {
            $this->delSession();
            errorLogger::writeUserMessages("Már van ilyen felhasználó bejelentkezve! Ezért kiléptettük a felhasználót");
            return false;
        }

        $_SESSION['login'] = true;
        $_SESSION['hash'] = $this->sessionHash;
        $_SESSION['id'] = $this->uId;
        $this->sessionDb->setSessionDb($this->uId, $this->sessionHash);

        return true;
    }

    /**
     * Delete the $_SESSION global and delete the session in the database, logging out the user.
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