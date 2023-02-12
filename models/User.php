<?php
require_once '../libraries/Database.php';

class User
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findUsersByEmailOrUsername($email, $username)
    {
        $this->db->query("SELECT * FROM users WHERE username = :username OR email = :email");

        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function register($data): bool
    {
        $this->db->query("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");

        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $row = $this->findUsersByEmailOrUsername($email, $email);

        if (!$row) return false;

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function resetPassword(string $selector, $currentDate)
    {
        $this->db->query('SELECT * FROM reset WHERE  selector = :selector AND reset.expire >= :currentDate');
        $this->db->bind(':selector', $selector);
        $this->db->bind(':currentDate', $currentDate);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
}