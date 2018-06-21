<?php
/**
 * Database query's for the SessionAuth object
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
 */

namespace Model\Session;
use Utils\dbConnect;

class SessionAuthDataManager implements SessionAuthDataManagerInterface
{
    // Database connection
    private $db;

    public function __construct()
    {
        $this->db = dbConnect::dbCon();
    }

    /**
     * Insert the actual session hash into the database with the user's Id
     *
     * @param $uId int The users unique Id
     * @param $hash string Unique hash
     */
    public function setSessionDb($uId,$hash){
        $sql = $this->db->prepare("INSERT INTO session(session, uId) VALUES (?,?)");
        $sql->execute([$hash,$uId]);
    }

    /**
     * Checks it the actuall session in the database where UserId is found
     *
     * @param $uId int User Id
     * @param $hash string Unique hash
     * @return bool
     */
    public function getSessionDb($uId,$hash){
        $sql = $this->db->prepare("SELECT id FROM session WHERE uId = ? AND session = ?");
        if($sql->execute([$uId,$hash])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Deletes the session from the database where UserId is found
     *
     * @param $uId int User Id
     * @return bool
     */
    public function delSessionDb($uId){
        $sql = $this->db->prepare("DELETE FROM session WHERE uId = ?");
        if($sql->execute([$uId])){
            return true;
        }else{
            return false;
        }
    }
}