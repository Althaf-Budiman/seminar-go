<?php


class PengajuanDosenPembimbing
{
    private $load;

    public function __construct()
    {
        $this->load  = new Loader();
    }

    public function index()
    {
        $this->load->view('views/pengajuan-dosen-pembimbing/index.php', [
            'pageTitle' => 'Pengajuan Dosen Pembimbing',
        ]);
    }
}
