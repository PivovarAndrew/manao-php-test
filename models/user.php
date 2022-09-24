<?php

class User
{
    private $email;
    private $login;
    private $name;
    private $password;
    private $password_confirm;

    public function __construct($email, $login, $name, $password, $password_confirm)
    {
        $this->email = $email;
        $this->login = $login;
        $this->name = $name;
        $this->password = $password;
        $this->password_confirm = $password_confirm;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPasswordConfirm()
    {
        return $this->password_confirm;
    }

    public function emailValidation()
    {
        return filter_var($this->getEmail(), FILTER_VALIDATE_EMAIL);
    }

    public function loginLengthValidation()
    {
        $MIN_SYMBOLS_COUNT = 6;
        return strlen($this->getLogin()) >= $MIN_SYMBOLS_COUNT;
    }

    public function loginWhiteSpacesValidation()
    {
        return !preg_match('/\s/', $this->getLogin());
    }

    public function nameLengthValidation()
    {
        $MIN_SYMBOLS_COUNT = 2;
        return strlen($this->getName()) >= $MIN_SYMBOLS_COUNT;
    }

    public function nameContentValidation()
    {
        return preg_match("/^\\pL+( \\pL+)*$/u", $this->getName()) && !preg_match('/\s/', $this->getName());
    }

    public function passwordLengthValidation()
    {
        $MIN_CHARS_COUNT = 6;
        return strlen($this->getPassword()) >= $MIN_CHARS_COUNT;
    }

    public function passwordContentValidation()
    {
        return preg_match("/(?=[a-z]*[0-9])(?=[0-9]*[a-z])([a-z0-9-]+)/i", $this->getPassword());
    }

    public function passwordWhiteSpacesValidation()
    {
        return !preg_match('/\s/', $this->getPassword());
    }

    public function passwordConfirmValidation()
    {
        return strcmp($this->getPassword(), $this->getPasswordConfirm()) == 0;
    }

    public function checkEmailUniqueness($users)
    {
        foreach ($users as $user) {
            if ($user->email == $this->getEmail()) {
                return false;
            }
        }
        return true;
    }

    public function checkLoginUniqueness($users)
    {
        return $this->find($users) ? false : true;
    }

    public function checkPassword($users)
    {
        $existedUser = $this->find($users);
        return $existedUser ? sha1($existedUser->salt . $this->getPassword()) == $existedUser->password : false;
    }

    private function find($users)
    {
        foreach ($users as $user) {
            if ($user->login == $this->getLogin()) {
                return $user;
            }
        }
        return false;
    }
}
