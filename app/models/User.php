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
        $sql = 'INSERT INTO users (fname,username,email,password) VALUES (:fname, :username,:email, :password)';
        //Prepare
        $this->db->query($sql);
        //Bind
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
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

    public function findUserByEmail($email)
    {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $this->db->query($sql);
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //check if row is 1 or 0
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserByEmail($email)
    {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $this->db->query($sql);
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        return $row;
    }

    public function getUserById($id){
        $sql = 'SELECT * FROM users WHERE id = :id';
        $this->db->query($sql);
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function getUsers(){
        $sql = 'SELECT * FROM users';
        $this->db->query($sql);

        $result = $this->db->result();

        return $result;
    }

    public function updateImage($data)
    {
        $sql = 'UPDATE users SET imgUrl = :imgUrl WHERE id = :id';
        //Prepare
        $this->db->query($sql);
        //Bind

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':imgUrl', $data['imgUrl']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($id)
    {
        $sql = 'DELETE FROM users WHERE  id = :id';
        //Prepare
        $this->db->query($sql);
        //Bind

        $this->db->bind(':id', $id);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
