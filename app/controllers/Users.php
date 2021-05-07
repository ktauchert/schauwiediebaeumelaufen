<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
	redirect('posts');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST["name"]),
                'email' => trim($_POST["email"]),
                'password' => trim($_POST["password"]),
                'confirm_password' => trim($_POST["confirm_password"]),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];
            
            // validate Email
            if (empty($data['email'])) {
                $data['email_error'] = 'Bitte eine Email-Adresse angeben';
            } else {
                // check email exists
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_error'] = 'Die Email ist schon vergeben';
                }
            }
            // validate Email
            if (empty($data['name'])) {
                $data['name_error'] = 'Bitte einen Benutzernamen angeben';
            }
            // validate Email
            if (empty($data['password'])) {
                $data['password_error'] = 'Bitte ein Benutzernamen angeben.';
            } else if (strlen($data['password']) < 8) {
                $data['password_error'] = 'Passwort muss mindestens 8 Stellen lang sein';
            }
            // validate Email
            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Bitte Passwort wiederholen';
            } else if ($data['password'] !== $data['confirm_password']) {
                $data['confirm_password_error'] = 'Passwörter stimmen nicht überein!';
            }

            if (
                empty($data["email_error"])
                && empty($data["name_error"])
                && empty($data["password_error"])
                && empty($data["confirm_password_error"])
            ) {
                // validated
                $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
                
                // REgister User
                if($this->userModel->register($data)){
                    flash('register_success', 'Sie sind jetzt registriert und können sich einloggen');
                    redirect('users/login');
                } else {
                    // FIXME: error message
                    die("Irgendwas ist schief gelaufen");
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }
        } else {
            // init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // load voew
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // init data
            $data = [
                'email' => trim($_POST["email"]),
                'password' => trim($_POST["password"]),
                'email_error' => '',
                'password_error' => '',
            ];
            // validate Email
            if (empty($data['email'])) {
                $data['email_error'] = 'Bitte eine Email-Adresse angeben';
            }
            // validate Email
            if (empty($data['password'])) {
                $data['password_error'] = 'Bitte ein Benutzernamen angeben.';
            }

            if($this->userModel->findUserByEmail($data["email"])){
                
            } else {
                flash('login_error', 'Benutzer und/oder Passwort sind fehlerhaft!', 'alert alert-danger');
            }

            if (
                empty($data["email_error"])
                && empty($data["password_error"])
            ) {
                // validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data["email"], $data["password"]);
                if($loggedInUser){
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    flash('login_error', 'Benutzer und/oder Passwort sind fehlerhaft!', 'alert alert-danger');
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            // init data
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
            ];

            // load voew
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION["user_id"] = $user->id;
        $_SESSION["user_email"] = $user->email;
        $_SESSION["user_name"] = $user->name;

        redirect('posts');
    }

    public function logout()
    {
        unset($_SESSION["user_id"]);
        unset($_SESSION["user_email"]);
        unset($_SESSION["user_name"]);

        session_destroy();

        redirect('users/login');
    }
}
