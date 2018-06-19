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

class UserController implements UserControllerInterface
{
    private $user;
    private $userDbManager;
    private $password;


    public function __construct(UserDataManagerInterface $userDbManager, PasswordInterface $pwd)
    {
        $this->user = new User();
        $this->userDbManager = $userDbManager;
        $this->password = $pwd;
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
        foreach ($userData as $key) {
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
    private function createUserReg($uName, $email, $pass1, $pass2)
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

    private function createUserLogin($uName, $pass)
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
     * @param $name
     * @param $email
     * @param $pass1
     * @param $pass2
     */
    public function register($name, $email, $pass1, $pass2)
    {
        if ($this->createUserReg($name, $email, $pass1, $pass2)) {
            if ($this->userDbManager->registerDB($this->user) == true) {
                errorLogger::writeUserMessages("Sikeres regisztráció!");
            } else {
                errorLogger::writeUserMessages("Már van ilyen felhasználó!");
            }
        }else{
            errorLogger::writeUserMessages("Hibás jelszó próbálkozzon újra");
        }
    }

    /**
     * Logs in the user, if everything allright(username, password), creates the user's session
     *
     * @param SessionAuthInterface $auth Session object for authentication across the application
     * @param $name string Username
     * @param $pass string Password
     * @return bool
     */
    public function login(SessionAuthInterface $auth,$name,$pass)
    {
        $this->createUserLogin($name,$pass);

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
     * @param SessionAuthInterface $auth Session object for authentication across the application
     * @return bool
     */
    public function logout(SessionAuthInterface $auth)
    {
        if ($auth->delSession()) {
            return true;
        } else {
            return false;
        }
    }


}