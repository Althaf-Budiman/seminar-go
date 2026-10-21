<?php


class Profil
{
    private $load;

    public function __construct()
    {
        $this->load  = new Loader();
    }

    public function index()
    {
        $this->load->view('views/profil/index.php', ['pageTitle' => "Profil"]);
    }
}
