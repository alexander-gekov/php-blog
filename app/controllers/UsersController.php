<?php

class UsersController extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $this->view('user/login');
    }

    public function login()
    {

        //POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

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
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            //Sanitize
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $data = [
                'fname' => trim($_POST["fname"]),
                'username' => trim($_POST["username"]),
                'password' => trim($_POST["password"]),
                'email' => trim($_POST["email"]),
                'confirm_password' => trim($_POST["confirm_password"]),
                'fname_err' => '',
                'username_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            if (empty($data['fname'])) {
                $data['fname_err'] = "Please enter a name.";
            }

            //Empty username or taken username
            if (empty($data['username'])) {
                $data['username_err'] = "Please enter a username.";
            } else {
                if ($this->userModel->findUserByUsername($data['username'])) {
                    $data['username_err'] = 'Username is already taken.';
                }
            }

            //EMail
            if (empty($data['email'])) {
                $data['email_err'] = "Please enter an email.";
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already in use.';
                }
            }

            //Empty password or password less than 6
            if (empty($data['password'])) {
                $data['password_err'] = "Please enter a password.";
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = "Password must have at least 6 characters.";
            }


            //Empty confirm password or not matching
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = "Please confirm password.";
            } else {
                if (($data['password'] != $data['confirm_password'])) {
                    $data['confirm_password_err'] = "Password did not match.";
                }
            }



            if (empty($data['fname_err']) && empty($data['username_err']) && empty($data['email_err'])
                && empty($data['password_err']) && empty($data['confirm_password_err'])) {

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
                echo 'dfdsfsf';
                print_r($data);
                $this->view('/users/register', $data);
            }
        } else {
            $data = [
                'fname' => '',
                'username' => '',
                'password' => '',
                'email' => '',
                'confirm_password' => '',
                'fname_err' => '',
                'username_err' => '',
                'email_err' => '',
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
        redirect('pages');
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->username;
        redirect('posts');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function isAdmin()
    {
        if ($_SESSION['user_id'] == ADMINID) {
            return true;
        } else {
            return false;
        }
    }

    public function my_profile()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $data = [
                'imgUrl' => '',
                'id' => $_SESSION['user_id']
            ];

            $file = $_FILES['image'];
            $fileName = $file['name'];
            $fileType = $file['type'];
            $fileTempName = $file['tmp_name'];
            $fileError = $file['error'];
            $fileSize = $file['size'];
            $imageFullName = '';

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 20000000) {
                        $imageFullName = uniqid('', false) . '.' . $fileActualExt;
                        $data['imgUrl'] = $imageFullName;
                        $fileDestination = $_SERVER['DOCUMENT_ROOT'] . '/wad-website/public/img/' . $imageFullName;
                        move_uploaded_file($fileTempName, $fileDestination);
                    }
                }

            }


            if ($this->userModel->updateImage($data)) {
                redirect('users/my_profile');
            }

        } else {
            if ($this->isLoggedIn()) {

                $user = $this->userModel->getUserById($_SESSION['user_id']);
                $data = [
                    'user' => $user,
                ];
                $this->view('users/my_profile', $data);
            } else {
                redirect('users/login');
            }
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
                $data['new_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
                if ($this->userModel->reset($_SESSION['user_id'], $data['new_password'])) {
                    //Flash
                    flash('password_change_success', 'You successfully changed your password.');
                    //Redirect
                    redirect('users/reset');
                } else {
                    die('Something went wrong.');
                }
            } else {
                //Load view with errors
                $this->view('users/reset', $data);
            }
        } else {
            $data = [
                'new_password' => '',
                'confirm_password' => '',
                'new_password_err' => '',
                'confirm_password_err' => '',
            ];

            //Load Form
            $this->view('users/reset', $data);
        }

    }

    public function recover()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $user = $this->userModel->getUserByEmail($email);
            $password = generateRandomString(6);

            $to = $user->email;
            $subject = "Password Reset";
            $email_body = "Your new password is " . $password . ". Please change it as soon as possible.";
            mail($to, $subject, $email_body);

            $hashed_password = password_hash($password);
            $this->userModel->reset($user->id, $hashed_password);
            flash('register_success', 'Password Reset Successfully.');
            $this->view('users/login');
        } else {
            $data = [
                'email_err' => ''
            ];
            $this->view('/users/forgotpassword', $data);
        }

    }

    public function delete($id)
    {
        if (!$this->isAdmin()) {
            redirect('/');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //check for owner
            if (!$this->isAdmin()) {
                redirect('/');
            }
            if ($this->userModel->deleteUser($id)) {
                flash('admin_message', 'User Removed');
                redirect('admin');
            } else {
                die();
            }

        } else {
            redirect('/');
        }
    }
}
