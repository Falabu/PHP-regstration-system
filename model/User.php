<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 13.
 * Time: 14:28
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