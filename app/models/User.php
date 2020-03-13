<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Connection();
    }

    public function register($data)
    {
        $sql = 'INSERT INTO users (username, password) VALUES (:username, :password)';
        //Prepare
        $this->db->query($sql);
        //Bind
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function login($username, $password)
    {
        $sql = 'SELECT * FROM users WHERE username = :username';
        //Prepare
        $this->db->query($sql);
        //Bind
        $this->db->bind(':username', $username);
        //Execute
        $row = $this->db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    //Reset password
    public function reset($id, $newpassword)
    {
        $sql = "UPDATE users SET password = :newpassword WHERE id = :id";

        $this->db->query($sql);
        $this->db->bind(':newpassword', $newpassword);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }


    }

    //Find user by username
    public function findUserByUsername($username)
    {
        $sql = 'SELECT * FROM users WHERE username = :username';
        $this->db->query($sql);
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        //check if row is 1 or 0
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}