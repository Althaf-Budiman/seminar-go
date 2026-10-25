
<?php

class BimbinganProposal
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    public function index()
    {
        $statistik = [
            'total'     => 4,
            'disetujui' => 3,
            'menunggu'  => 1,
        ];

        // State: done | active | locked
        $persyaratan = [
            [
                'judul'     => 'Minimal 3 kali bimbingan',
                'state'     => 'done',
                'badge'     => 'Terpenuhi',
                'badgeClass'=> 'success',
            ],
            [
                'judul'     => 'Persetujuan dosen pembimbing',
                'state'     => 'active',
                'badge'     => 'Menunggu',
                'badgeClass'=> 'warning',
            ],
        ];

        $riwayat = [
            [
                'nomor'     => 1,
                'judul'     => 'Diskusi Awal Topik & Ruang Lingkup',
                'state'     => 'done',
                'badge'     => 'Disetujui',
                'badgeClass'=> 'success',
            ],
            [
                'nomor'     => 2,
                'judul'     => 'Bab I: Latar Belakang & Rumusan Masalah',
                'state'     => 'done',
                'badge'     => 'Disetujui',
                'badgeClass'=> 'success',
            ],
            [
                'nomor'     => 3,
                'judul'     => 'Bab II: Tinjauan Pustaka',
                'state'     => 'done',
                'badge'     => 'Disetujui',
                'badgeClass'=> 'success',
            ],
            [
                'nomor'     => 4,
                'judul'     => 'Bab III: Metodologi Penelitian',
                'state'     => 'active',
                'badge'     => 'Menunggu',
                'badgeClass'=> 'warning',
            ],
        ];

        $this->load->view('views/bimbingan-proposal/index.php', [
            'pageTitle'  => 'Bimbingan Proposal',
            'activeMenu' => 'bimbingan-proposal',
            'statistik'  => $statistik,
            'persyaratan'=> $persyaratan,
            'riwayat'    => $riwayat,
            'progress'   => 100,
        ]);
    }
}
