<?php

class PagesController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        if (isLoggedIn()) {
            redirect('posts');
        }

        $data = [
            'title' => SITENAME,
        ];


        $this->view('pages/index', $data);
    }


}