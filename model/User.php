<?php
/**
 * General User class to store user information
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

class User
{
    private $uName;
    private $uPassword;
    private $uId;
    private $uEmail;

    /**
     * @return mixed
     */
    public function getUName()
    {
        return $this->uName;
    }

    /**
     * @return mixed
     */
    public function getUPassword()
    {
        return $this->uPassword;
    }

    /**
     * @return mixed
     */
    public function getUId()
    {
        return $this->uId;
    }

    /**
     * @return mixed
     */
    public function getUEmail()
    {
        return $this->uEmail;
    }

    /**
     * @param mixed $uName
     */
    public function setUName($uName)
    {
        $this->uName = $uName;
    }

    /**
     * @param mixed $uPassword
     */
    public function setUPassword($uPassword)
    {
        $this->uPassword = $uPassword;
    }

    /**
     * @param mixed $uId
     */
    public function setUId($uId)
    {
        $this->uId = $uId;
    }

    /**
     * @param mixed $uEmail
     */
    public function setUEmail($uEmail)
    {
        $this->uEmail = $uEmail;
    }



}