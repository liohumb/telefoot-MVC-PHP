<?php
require_once '../models/User.php';
require_once '../helpers/session_helper.php';

class Users
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User;
    }

    public function register(): void
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        $data = [
            'username' => trim(strip_tags($_POST['username'])),
            'email' => trim(strip_tags($_POST['email'])),
            'password' => trim(strip_tags($_POST['password'])),
            'passwordConfirm' => trim(strip_tags($_POST['passwordConfirm']))
        ];

        if (empty($data['username']) || empty($data['email']) || empty($data['password']) || empty($data['passwordConfirm'])) {
            flash('register', "Merci de renseigner tout les champs de saisies");
            redirect('../register.php');
        }

        if (!preg_match("/^[a-zA-Z0-9]*$/", $data['username'])) {
            flash("register", "Merci de vérifier l'orthographe de votre nom d'utilisateur");
            redirect("../register.php");
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            flash("register", "Merci de vérifier votre adresse email (exemple: 'votre'@'email'.'com'");
            redirect("../register.php");
        }

        if (strlen($data['password']) < 6) {
            flash("register", "Votre mot de passe n'est pas assez fort");
            redirect("../register.php");
        } else if ($data['password'] !== $data['passwordConfirm']) {
            flash("register", "Votre mot de passe et sa confirmation doivent être identique");
            redirect("../register.php");
        }

        if ($this->userModel->findUsersByEmailOrUsername($data['email'], $data['username'])) {
            flash("register", "Le nom d'utilisateur ou l'adresse email sont déjà enregistrés");
            redirect("../register.php");
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if ($this->userModel->register($data)) {
            redirect("../connexion.php");
        } else {
            die("Une erreur est survenue, merci de réessayer ultérieurement");
        }
    }

    public function login(): void
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        $data = [
            'email' => trim(strip_tags($_POST['email'])),
            'password' => trim(strip_tags($_POST['password']))
        ];

        if (empty($data['email']) || empty($data['password'])) {
            flash("login", "Merci de renseigner tout les champs de saisies");
            header("location: ../connexion.php");
            exit();
        }

        if ($this->userModel->findUsersByEmailOrUsername($data['email'], $data['email'])) {
            $loggedInUser = $this->userModel->login($data['email'], $data['password']);

            if ($loggedInUser) {
                $this->createUserSession($loggedInUser);
            } else {
                flash("login", "Mot de passe incorrect");
                redirect("../connexion.php");
            }
        } else {
            flash("login", "Utilisateur inconnue");
            redirect("../connexion.php");
        }
    }

    public function createUserSession($user): void
    {
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;

        redirect("../live.php");
    }

    public function logout(): void
    {
        unset($_SESSION['username']);
        unset($_SESSION['email']);

        session_destroy();
        redirect("../index.php");
    }
}

$init = new Users;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case'register':
            $init->register();
            break;
        case 'login':
            $init->login();
            break;
        default:
            redirect('../index.php');
    }
} else {
    switch ($_GET['q']) {
        case 'logout':
            $init->logout();
            break;
        default:
            redirect('../index.php');
    }
}