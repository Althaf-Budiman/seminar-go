<?php


class ManajemenAkunMahasiswa
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
                'kelas' => 'TI 8A',
                'prodi' => 'TI',
                'email' => '[EMAIL_ADDRESS]',
            ],
        ];

        $this->load->view('views/admin/manajemen-akun-mahasiswa/index.php', [
            'pageTitle' => 'Manajemen Akun Mahasiswa',
            'accounts'  => $accounts,
        ]);
    }

    public function create()
    {
        $this->load->view('views/admin/manajemen-akun-mahasiswa/form.php', [
            'pageTitle'   => 'Tambah Akun Mahasiswa',
            'activeMenu'  => 'manajemen-akun-mahasiswa',
        ]);
    }
}
