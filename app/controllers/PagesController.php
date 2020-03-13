<?php

class PagesController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {

        $data = [
            'title' => SITENAME,
        ];


        $this->view('pages/index', $data);
    }


}