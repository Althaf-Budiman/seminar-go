<?php


class ManajemenAkunDosenPembimbing
{
    private $load;

    public function __construct()
    {
        $this->load  = new Loader();
    }

    public function index()
    {
        $accounts = [
            [
                'id'             => 1,
                'nama' => 'Nadia Putri Ramadhani',
                'identification_number'  => '2207411024',
                'status'  => 'Aktif',
                'bidang_peminatan'  => 'AI',
                'email' => '[EMAIL_ADDRESS]',
            ],
        ];

        $this->load->view('views/manajemen-akun-dosen-pembimbing/index.php', [
            'pageTitle' => 'Manajemen Akun Dosen Pembimbing',
            'accounts'  => $accounts,
        ]);
    }

    public function create()
    {
        $this->load->view('views/manajemen-akun-dosen-pembimbing/form.php', [
            'pageTitle'   => 'Tambah Akun Dosen Pembimbing',
            'activeMenu'  => 'manajemen-akun-dosen-pembimbing',
        ]);
    }
}
