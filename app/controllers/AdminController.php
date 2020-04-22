<?php

class AdminController extends Controller
{

    public function __construct()
    {
        if (!isLoggedIn() && !isAdmin()) {
            redirect('pages');
        }
        $this->userModel = $this->model('User');
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $users = $this->userModel->getUsers();

        foreach ($users as $user){
            $user->postCount=$this->postModel->getPostCount($user->id);
        }

        $data = [
            'users' => $users
        ];

        $this->view('admin/index', $data);
    }


}