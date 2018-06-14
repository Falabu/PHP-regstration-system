<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 13.
 * Time: 14:30
 */

class Password
{
    private $password;

    /**
     *
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
     * @param mixed $pwd
     * @return string
     */
    public function hashPassword($pwd)
    {
        $this->password = $pwd;
        return $this->passwordHash();
    }

    /**
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
     * @return string
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
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


}