<?php

class Login
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    public function index()
    {
        $this->load->view('views/login/index.php');
    }

    public function store()
    {
        header('Location: ' . BASE_URL . '/beranda');
        exit;
    }
}
