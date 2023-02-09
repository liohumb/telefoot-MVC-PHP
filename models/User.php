<?php
require_once '../libraries/Database.php';
class User
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findUsersByEmailOrUsername($email, $username) {
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

    public function register($data) {
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
}