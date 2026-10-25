<?php


class PengajuanTopikPembimbing
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
        $usulan = [
            ['nama' => 'Dosen, M.T.',   'prioritas' => 1],
            ['nama' => 'Dosen, M.Kom.', 'prioritas' => 2],
            ['nama' => 'Dosen, M.Eng.', 'prioritas' => 3],
        ];

        // state: done | active | locked
        $penelaahan = [
            ['judul' => 'Pengajuan Terkirim',          'state' => 'done',   'badge' => 'Selesai',   'badgeClass' => 'success'],
            ['judul' => 'Review Koordinator',          'state' => 'active', 'badge' => 'Menunggu',  'badgeClass' => 'warning'],
            ['judul' => 'Penetapan Dosen Pembimbing',  'state' => 'locked', 'badge' => 'Terkunci',  'badgeClass' => 'neutral'],
        ];

        $this->load->view('views/pengajuan-topik-pembimbing/index.php', [
            'pageTitle'  => 'Pengajuan Topik & Pembimbing',
            'activeMenu' => 'pengajuan-topik',
            'formulir'   => $this->getFormulir(),
            'usulan'     => $usulan,
            'penelaahan' => $penelaahan,
        ]);
    }
}
