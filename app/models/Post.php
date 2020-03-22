<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Connection();
    }

    public function getPosts()
    {
        $this->db->query('SELECT *,
                              posts.id as postId,
                              users.id as userId,
                              posts.imgPath as imgPath 
                              FROM posts
                              INNER JOIN users
                              ON  posts.user_id = users.id
                              ORDER BY posts.created_at DESC');

        $results = $this->db->result();

        return $results;
    }

    public function createPost($data){
        $sql = 'INSERT INTO posts (title, text, user_id, imgPath) VALUES (:title, :text, :user_id, :imgPath)';
        //Prepare
        $this->db->query($sql);
        //Bind
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':text', $data['text']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':imgPath', $data['imgPath']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}