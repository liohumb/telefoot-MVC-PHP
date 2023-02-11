<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once '../models/Reset.php';
require_once '../helpers/session_helper.php';
require_once '../models/User.php';

require_once '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../vendor/phpmailer/phpmailer/src/Exception.php';
require_once '../vendor/phpmailer/phpmailer/src/SMTP.php';

class Resets
{
    private Reset $resetModel;
    private User $userModel;
    private PHPMailer $mail;

    public function __construct()
    {
        $this->resetModel = new Reset;
        $this->userModel = new User;

        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'sandbox.smtp.mailtrap.io';
        $this->mail->SMTPAuth = true;
        $this->mail->Port = 2525;
        $this->mail->Username = '8adcb7609cf57c';
        $this->mail->Password = '7b44231cb19335';
    }

    /**
     * @throws \PHPMailer\PHPMailer\Exception
     * @throws Exception
     */
    public function sendEmail(): void
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
        $email = trim(strip_tags($_POST['email']));

        if (empty($email)) {
            flash("reset", "Merci de renseigner votre adresse email");
            redirect("../reset.php");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash("reset", "Merci de vérifier l'orthographe de votre adresse email");
            redirect("../reset.php");
        }

        $selector = bin2hex(random_bytes(8));

        $token = random_bytes(32);

        $url = 'https://telefoot:8890/new-password.php?selector=' . $selector . '&validator=' . bin2hex($token);

        $expire = date('U') + 1800;

        if (!$this->resetModel->deleteEmail($email)) {
            die("Une erreur est survenue, merci de réessayer ultérieurement");
        }

        $hashedToken = password_hash($token, PASSWORD_DEFAULT);

        if (!$this->resetModel->insertToken($email, $selector, $hashedToken, $expire)) {
            die("Une erreur est survenue, merci de réessayer ultérieurement");
        }

        $subject = "Réinitialiser votre mot de passe";
        $message = "<p>Nous avons reçu une demande de réinitialisation de mot de passe</p>";
        $message .= "<p>Voici votre lien pour changer de mot de passe: </p>";
        $message .= "<a href='" . $url . "'>" . $url . "</a>";

        $this->mail->setFrom('emailpourtesterdestrucs@gmail.com');
        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;
        $this->mail->addAddress($email);

        $this->mail->send();

        flash("reset", "Nous vous avons envoyé un lien pour réinitialiser votre mot de passe");
        redirect("../reset.php");
    }

    public function resetPassword(): void
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
        $data = [
            'selector' => trim($_POST['selector']),
            'validator' => trim($_POST['validator']),
            'password' => trim($_POST['password'])
        ];
        $url = 'https://telefoot:8890/new-password.php?selector=' . $data['selector'] . '&validator=' . $data['validator'];

        if (empty($_POST['password'])) {
            flash("new", "Merci de saisir votre nouveau mot de passe");
            redirect($url);
        } else if (strlen($data['password']) < 6) {
            flash("new", "Mot de passe trop faible");
            redirect($url);
        }

        $currentDate = date("U");

        if (!$row = $this->resetModel->resetPassword($data['selector'], $currentDate)) {
            flash("new", "Désolé mais ce lien n'est plus fonctionnel, merci de recommencer");
            redirect($url);
        }

        $tokenBin = hex2bin($data['validator']);
        $tokenCheck = password_verify($tokenBin, $row->pwdResetToken);

        if (!$tokenCheck) {
            flash("new", "Une erreur est survenue, merci de recommencer");
            redirect($url);
        }

        $tokenEmail = $row->pwdResetEmail;

        if (!$this->userModel->findUsersByEmailOrUsername($tokenEmail, $tokenEmail)) {
            flash("new", "Une erreur est survenue, merci de recommencer");
            redirect($url);
        }

        $newPwdHash = password_hash($data['password'], PASSWORD_DEFAULT);

        if (!$this->userModel->resetPassword($newPwdHash, $tokenEmail)) {
            flash("new", "Une erreur est survenue, merci de recommencer");
            redirect($url);
        }

        if (!$this->resetModel->deleteEmail($tokenEmail)) {
            flash("new", "Une erreur est survenue, merci de recommencer");
            redirect($url);
        }

        flash("new", "Le mot de passe a bien été mis à jour");
        redirect($url);
    }
}

$init = new Resets;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'send':
            $init->sendEmail();
            break;
        case 'reset':
            $init->resetPassword();
            break;
        default:
            header('location: ../index.php');
    }
} else {
    header('location: ../index.php');
}