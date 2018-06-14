<?php
/**
 * Executing User operations
 *
 * register
 * login
 * update user info
 *
 *
 * Class UserController
 */

class UserController
{
    private $user;
    private $userDbManager;
    private $password;


    public function __construct()
    {
        $this->user = new User();
        $this->userDbManager = new UserDataManager();
        $this->password = new Password();
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Populate the User object with users's information
     *
     * @param $uId integer Users Id
     */
    public function setUserById($uId)
    {
        $userData = $this->userDbManager->getUserDataById($uId);
        foreach ($userData as $key){
            $this->user->setUEmail($key['email']);
            $this->user->setUName($key['username']);
        }
    }

    /**
     * Prepare the user obeject for registration, setting the required fields(Username, Email, Password)
     *
     * @param $uName string The username for registration
     * @param $email string The users email address
     * @param $pass1 string The users password
     * @param $pass2 string The users password one more time for checking propuse
     * @return bool
     */
    public function createUserReg($uName, $email, $pass1, $pass2)
    {
        $this->user->setUName($uName);
        $this->user->setUEmail($email);

        if ($this->password->createPassword($pass1, $pass2)) {
            $this->user->setUPassword($this->password->getPassword());
            return true;
        } else {
            return false;
        }
    }

    /**
     * Prepare the user obeject for login, setting the required fields(Username, Password)
     *
     * @param $uName string The users username for login
     * @param $pass string The users password
     */

    public function createUserLogin($uName, $pass)
    {
        $this->user->setUName($uName);
        $this->password->hashPassword($pass);

        $this->user->setUPassword($this->password->getPassword());

    }

    public function updateUserData()
    {

    }

    /**
     * Register the user if there is no same user in the database
     *
     * @return bool
     */
    public function register()
    {
        if ($this->userDbManager->registerDB($this->user) == true) {
            errorLogger::writeUserMessages("Sikeres regisztráció!");
            return true;
        } else {
            errorLogger::writeUserMessages("Már van ilyen felhasználó!");
            return false;
        }
    }

    /**
     * Logs in the user, if everything allright(username, password), creates the user's session
     *
     * @param SessionAuth $auth Session object for authentication on all pages
     * @return bool
     */
    public function login(SessionAuth $auth)
    {
        if ($this->userDbManager->loginDb($this->user)) {
            $auth->setSession($this->user->getUId());
            return true;
        } else {
            errorLogger::writeUserMessages("Nem jó a jelszó vagy a felhasználónév!");
            return false;
        }
    }

    /**
     * Logs out the user by deleting the session
     *
     * @param SessionAuth $auth Session object for authentication on all pages
     * @return bool
     */
    public function logout(SessionAuth $auth)
    {
        if ($auth->delSession()) {
            return true;
        } else {
            return false;
        }
    }


}