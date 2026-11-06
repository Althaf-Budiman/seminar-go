<?php

class NilaiDanRevisi
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    private function getMahasiswa(): array
    {
        return [
            ['id' => 1, 'nama' => 'Si Mahasiswa', 'avatar' => '👤'],
            ['id' => 2, 'nama' => 'Si Mahasiswa', 'avatar' => '👤'],
            ['id' => 3, 'nama' => 'Si Mahasiswa', 'avatar' => '👤'],
            ['id' => 4, 'nama' => 'Si Mahasiswa', 'avatar' => '👤'],
            ['id' => 5, 'nama' => 'Si Mahasiswa', 'avatar' => '👤'],
            ['id' => 6, 'nama' => 'Si Mahasiswa', 'avatar' => '👤'],
            ['id' => 7, 'nama' => 'Si Mahasiswa', 'avatar' => '👤'],
            ['id' => 8, 'nama' => 'Si Mahasiswa', 'avatar' => '👤'],
            ['id' => 9, 'nama' => 'Si Mahasiswa', 'avatar' => '👤'],
            ['id' => 10, 'nama' => 'Si Mahasiswa', 'avatar' => '👤'],
        ];
    }

    public function index()
    {
        $this->load->view('views/dosen/nilai-dan-revisi/index.php', [
            'pageTitle'  => 'Nilai dan Revisi',
            'activeMenu' => 'nilai-dan-revisi',
            'mahasiswa'  => $this->getMahasiswa(),
        ]);
    }

    public function tambah()
    {
        $this->load->view('views/dosen/nilai-dan-revisi/detail.php', [
            'pageTitle'  => 'Tambah Nilai Skripsi',
            'activeMenu' => 'nilai-dan-revisi',
        ]);
    }
}
