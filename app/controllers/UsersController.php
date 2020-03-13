<?php

class UsersController extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {

    }

    public function login()
    {

        //POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Sanitize
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $data = [
                'username' => trim($_POST["username"]),
                'password' => trim($_POST["password"]),
                'username_err' => '',
                'password_err' => '',
            ];
            if (empty($data['username'])) {
                $data['username_err'] = "Please enter username.";
            }

            if (empty($data['password'])) {
                $data['password_err'] = "Please enter password.";
            }

            //Check for username
            if ($this->userModel->findUserByUsername($data['username'])) {
                //User found
            } else {
                $data['username_err'] = 'User not found';
            }

            if (empty($data['username_err']) && empty($data['password_err'])) {

                $loggedUser = $this->userModel->login($data['username'], $data['password']);

                if ($loggedUser) {
                    $this->createUserSession($loggedUser);
                } else {
                    $data['password_err'] = 'Password incorrect';

                    $this->view('/users/login', $data);
                }
            } else {
                //Load form with errors
                $this->view('/users/login', $data);
            }
        } else {
            $data = ['username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => '',];

            //Load Form
            $this->view('/users/login', $data);
        }
    }


    public function register()
    {
//POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Sanitize
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $data = [
                'username' => trim($_POST["username"]),
                'password' => trim($_POST["password"]),
                'confirm_password' => trim($_POST["confirm_password"]),
                'username_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            //Empty username or taken username
            if (empty($data['username'])) {
                $data['username_err'] = "Please enter a username.";
            } else {
                if ($this->userModel->findUserByUsername($data['username'])) {
                    $data['username_err'] = 'Username is already taken.';
                }
            }

            //Empty password or password less than 6
            if (empty($data['password'])) {
                $data['password_err'] = "Please enter a password.";
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = "Password must have atleast 6 characters.";
            }


            //Empty confirm password or not matching
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = "Please confirm password.";
            } else {
                if (($data['password'] != $data['confirm_password'])) {
                    $data['confirm_password_err'] = "Password did not match.";
                }
            }

            if (empty($data['username_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {

                //Password Hash
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register function
                if ($this->userModel->register($data)) {
                    //Flash
                    flash('register_success', 'You are registered and can log in now.');
                    //Redirect
                    redirect('users/login');
                } else {
                    die('Something went wrong.');
                }

            } else {
                //Load view with errors
                $this->view('/users/register', $data);
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'confirm_password' => '',
                'username_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            //Load Form
            $this->view('/users/register', $data);
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('/pages/index');
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->username;
        redirect('/pages/index');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function reset()
    {
//POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'new_password' => trim($_POST["new_password"]),
                'confirm_password' => trim($_POST["confirm_password"]),
                'password_err' => '',
                'confirm_password_err' => '',
            ];


            if (empty($data['new_password'])) {
                $data['new_password_err'] = "Please enter the new password.";
            } elseif (strlen($data['new_password']) < 6) {
                $data['new_password_err'] = "Password must have atleast 6 characters.";
            }

            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = "Please confirm the password.";
            } else {
                if (empty($data['new_password_err']) && ($data['new_password'] != $data['confirm_password'])) {
                    $data['confirm_password_err'] = "Password did not match.";
                }
            }

            if (empty($data['new_password_err']) && empty($data['confirm_password_err'])) {
                if ($this->userModel->reset($_SESSION['user_id'], $data['new_password'])) {
                    //Flash
                    flash('password_change_success', 'You successfully changed your password.');
                    //Redirect
                    redirect('users/reset');
                } else {
                    die('Something went wrong.');
                }
            }
            else {
                //Load view with errors
                $this->view('/users/reset', $data);
            }
        }
        else{
            $data = [
                'new_password' => '',
                'confirm_password' => '',
                'new_password_err' => '',
                'confirm_password_err' => '',
            ];

            //Load Form
            $this->view('/users/reset', $data);
        }

    }
}