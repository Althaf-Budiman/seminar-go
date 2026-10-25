<?php


class FormulirPengajuanTopik
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    // Data dummy
    private function getFormulir()
    {
        return [
            'status'     => 'Draft',
            'judul'      => 'Aplikasi Pencatatan Menu dan Kandungan Gizi untuk Pengelolaan Data MBG',
            'topik'      => 'Sistem Informasi Kesehatan & Pemantauan Nutrisi Berbasis Web',
            'bidang'     => 'Rekayasa Perangkat Lunak',
            'ringkasan'  => 'Sistem terintegrasi untuk mendata distribusi makanan bergizi, menghitung estimasi kecukupan makronutrien, dan pelaporan berkala secara terpusat untuk program intervensi gizi nasional.',
        ];
    }

    public function index()
    {
        $dosen = [
            'Dosen, M.T.',
            'Dosen, M.Kom.',
            'Dosen, M.Eng.',
            'Dosen, Ph.D.',
        ];

        $bidang = [
            'Rekayasa Perangkat Lunak',
            'Kecerdasan Buatan',
            'Jaringan dan Keamanan',
            'Sistem Informasi',
        ];

        $this->load->view('views/formulir-pengajuan-topik/index.php', [
            'pageTitle'  => 'Formulir Pengajuan Topik',
            'activeMenu' => 'formulir-topik',
            'formulir'   => $this->getFormulir(),
            'dosen'      => $dosen,
            'bidang'     => $bidang,
        ]);
    }
}
