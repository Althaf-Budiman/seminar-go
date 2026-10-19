<?php


class Beranda
{
    private $load;

    public function __construct()
    {
        $this->load  = new Loader();
    }

    public function index()
    {
        $this->load->view('views/beranda/index.php');
    }
}
