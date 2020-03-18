<?php

class PostsController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        $data = [];
        $this->view('posts/index', $data);
    }
}