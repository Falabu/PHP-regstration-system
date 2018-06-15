<?php
/**
 * A helper class for Code object, it conatins the database querys
 *
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
 * Time: 15:03
 */

class CodeDataManager
{
    private $db;

    /**
     * Creating the connection
     *
     * CodeDataManager constructor.
     *
     */
    public function __construct()
    {
        $this->db = dbConnect::dbCon();
    }

    /**
     * Upload to database with a specific user ID
     *
     * @param $uId int User Id
     * @param $code string Code
     */
    public function upload($uId, $code){
        $sql = $this->db->prepare("INSERT INTO codes(code, uId) VALUES (?,?)");
        $sql->execute([$code,$uId]);
    }

    /**
     * Gets the codes for the specific User ID
     *
     * @param $uId int User Id
     * @return array This array contains the codes
     *
     */
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