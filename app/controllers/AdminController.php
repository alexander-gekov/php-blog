<?php

class AdminController extends Controller
{

    public function __construct()
    {
        if (!isLoggedIn() && !isAdmin()) {
            redirect('pages');
        }
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $users = $this->userModel->getUsers();
        $data = [
            'users' => $users,
            'postCount' => 33,
        ];

        $this->view('admin/index', $data);
    }


}