<?php


class ManajemenAkun
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
                'email' => '[EMAIL_ADDRESS]',
                'role' => 'Mahasiswa',
            ],
        ];

        $this->load->view('views/manajemen-akun/index.php', [
            'pageTitle' => 'Manajemen Akun',
            'accounts'  => $accounts,
        ]);
    }

    public function create()
    {
        $this->load->view('views/manajemen-akun/form.php', [
            'pageTitle'   => 'Tambah Akun',
            'activeMenu'  => 'manajemen-akun',
        ]);
    }
}
