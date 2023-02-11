<?php

class Reset
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function deleteEmail($email): bool
    {
        $this->db->query('DELETE FROM reset WHERE email = :email');
        $this->db->bind(':email',$email);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function insertToken($email, $selector, $hashedToken, $expire): bool
    {
        $this->db->query('INSERT INTO reset (email, selector, token, expire) VALUES (:email, :selector, :token, :expire)');
        $this->db->bind(':email', $email);
        $this->db->bind(':selector', $selector);
        $this->db->bind(':token', $hashedToken);
        $this->db->bind(':expire', $expire);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function resetPassword($selector, $currentDate){
        $this->db->query('SELECT * FROM reset WHERE  selector = :selector AND reset.expire >= :currentDate');
        $this->db->bind(':selector',$selector);
        $this->db->bind(':currentDate',$currentDate);

        $row = $this->db->single();

        if($this->db->rowCount() > 0){
            return $row;
        }else{
            return false;
        }
    }
}