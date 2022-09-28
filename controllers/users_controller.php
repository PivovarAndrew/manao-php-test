<?php

require_once '../models/user.php';
require_once '../core/json_db.php';
require_once '../core/cookie.php';
require_once '../util/input.php';
require_once '../helpers/session_helper.php';

if (!isset($_SESSION)) {
    session_start();
}

class UsersController
{
    private $db;

    private $DB_TABLE_NAME = "users";
    private $DB_FILE_FORMAT = ".json";

    public function __construct()
    {
        $this->db = new JsonDB($this->DB_TABLE_NAME . $this->DB_FILE_FORMAT);
    }

    public function signUp()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $user = new User(
            Input::validateData($_POST['email']),
            Input::validateData($_POST['login']),
            Input::validateData($_POST['name']),
            Input::validateData($_POST['password']),
            Input::validateData($_POST['password_confirm'])
        );

        if ($user->getEmail()) {
            if ($user->emailValidation()) {
                if (!$user->checkEmailUniqueness($this->db->getData())) {
                    flash('sign_up', 'email', "User with the same email exists.");
                }
            } else {
                flash('sign_up', 'email', "Incorrect email format");
            }
        } else {

            flash('sign_up', 'email', "Email is required field.");
        }

        if ($user->getLogin()) {
            if ($user->loginLengthValidation()) {
                if ($user->loginWhiteSpacesValidation()) {
                    if (!$user->checkLoginUniqueness($this->db->getData())) {
                        flash('sign_up', 'login', "User with the same login exists.");
                    }
                } else {
                    flash('sign_up', 'login', "Login must not contain whitespaces.");
                }
            } else {
                flash('sign_up', 'login', "Login is too short.");
            }
        } else {
            flash('sign_up', 'login', "Login is required field.");
        }

        if ($user->getName()) {
            if ($user->nameLengthValidation()) {
                if (!$user->nameContentValidation()) {
                    flash('sign_up', 'name', "Name must contain only letters.");
                }
            } else {
                flash('sign_up', 'name', "Name is too short.");
            }
        } else {
            flash('sign_up', 'name', "Name is required field.");
        }

        if ($user->getPassword()) {
            if ($user->passwordLengthValidation()) {
                if ($user->passwordWhitespacesValidation()) {
                    if (!$user->passwordContentValidation()) {
                        flash('sign_up', 'password', "Password must contain letters and numbers.");
                    }
                } else {
                    flash('sign_up', 'password', "Password must not contain whitespaces.");
                }
            } else {
                flash('sign_up', 'password', "Password is too short.");
            }
        } else {
            flash('sign_up', 'password', "Password is required field.");
        }

        if ($user->getPasswordConfirm()) {
            if (!$user->passwordConfirmValidation()) {
                flash('sign_up', 'password_confirm', "Passwords don't match");
            }
        } else {
            flash('sign_up', 'password_confirm', "Password confirmation is required field.");
        }

        if (!$_SESSION['flashes'][$_POST["type"]]) {
            $salt = sha1(microtime() . $user->getPassword());
            $this->db->addItem([
                'email' => $user->getEmail(),
                'login' => $user->getLogin(),
                'name' => $user->getName(),
                'password' =>  sha1($salt . $user->getPassword()),
                "salt" => $salt
            ]);
            $_SESSION['logged_in'] = true;
            setcookie('user_name', $user->getName(), time() + Cookie::$COOKIE_LIFETIME, Cookie::$COOKIE_DEFAULT_PATH);
            echo json_encode(["success" => true]);
        } else {
            Input::rememberFields($_POST);
            echo json_encode(["success" => false]);
        }
    }

    public function signIn()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $user = new User(
            null,
            Input::validateData($_POST['login']),
            null,
            Input::validateData($_POST['password']),
            null
        );
        if ($user->getLogin()) {
            if ($user->checkLoginUniqueness($this->db->getData())) {
                flash('sign_in', 'login', "This user doesn't exist. Please sign up.");
            }
        } else {
            flash('sign_in', 'login', "Login is required field.");
        }

        if ($user->getPassword()) {
            if (!$user->checkPassword($this->db->getData())) {
                flash('sign_in', 'password', "Wrong password.");
            }
        } else {
            flash('sign_in', 'password', "Password is required field.");
        }

        if (!$_SESSION['flashes'][$_POST["type"]]) {
            $_SESSION['logged_in'] = true;
            echo json_encode(["success" => true]);
        } else {
            Input::rememberFields($_POST);
            echo json_encode(["success" => false]);
        }
    }

    public function logout()
    {
        unset($_SESSION['logged_in']);
        session_destroy();
        echo 0;
    }
}

$init = new UsersController;

if ($_SERVER['HTTP_X_REQUESTED_WITH']) {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            switch ($_POST['type']) {
                case 'sign_up':
                    $init->signUp();
                    break;
                case 'sign_in':
                    $init->signIn();
                    break;
            }
            break;
        case 'DELETE':
            $init->logout();
            break;
    }
}
