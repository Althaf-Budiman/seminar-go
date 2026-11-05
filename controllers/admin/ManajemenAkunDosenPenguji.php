<?php


class ManajemenAkunDosenPenguji
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
                'bidang_keahlian'  => 'AI',
                'email' => '[EMAIL_ADDRESS]',
            ],
        ];

        $this->load->view('views/admin/manajemen-akun-dosen-penguji/index.php', [
            'pageTitle' => 'Manajemen Akun Dosen Penguji',
            'accounts'  => $accounts,
        ]);
    }

    public function create()
    {
        $this->load->view('views/admin/manajemen-akun-dosen-penguji/form.php', [
            'pageTitle'   => 'Tambah Akun Dosen Penguji',
            'activeMenu'  => 'manajemen-akun-dosen-penguji',
        ]);
    }
}
