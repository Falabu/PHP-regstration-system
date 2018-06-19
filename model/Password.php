<?php
/**
 *  Hashing and password checking class
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
 */

class Password implements PasswordInterface
{
    private $password;

    /**
     * Hash the password if the 2 password is equal and put in $password var
     *
     * @param $pwd1
     * @param $pwd2
     * @return string
     */

    public function createPassword($pwd1, $pwd2)
    {
        if (!$this->checkIfEqual($pwd1, $pwd2)) {
            errorLogger::writeUserMessages("A két jelszó nem azonos");
            return false;
        } else {
            $this->password = $pwd1;
            $this->passwordHash();

            return true;
        }
    }


    /**
     * Creates the hashed password
     *
     * @param string $pwd
     * @return string
     */
    public function hashPassword($pwd)
    {
        $this->password = $pwd;
        return $this->passwordHash();
    }

    /**
     * Check is the two password is equal
     *
     * @param $pwd1
     * @param $pwd2
     * @return bool
     */
    private function checkIfEqual($pwd1, $pwd2)
    {
        if ($pwd1 == $pwd2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Creates the password hash with a uniqe key
     */

    private function passwordHash()
    {
        $key = "Lkret=8d1,,dhjasÚó5";
        $pwd = $this->password;

        for ($i = 0; $i < 500; $i++) {
            $pwd = md5($pwd . $key);
        }

        $this->password = $pwd;
    }

    /**
     * return the $password var
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


}