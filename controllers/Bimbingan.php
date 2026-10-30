<?php

class Bimbingan
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    public function index()
    {
        // Data for Seminar Proposal
        $sempro = [
            'title'       => 'Bimbingan Proposal',
            'statistik'   => [
                'total'     => 4,
                'disetujui' => 3,
                'menunggu'  => 1,
            ],
            'persyaratan' => [
                [
                    'judul'      => 'Minimal 3 kali bimbingan',
                    'state'      => 'done',
                    'badge'      => 'Terpenuhi',
                    'badgeClass' => 'success',
                ],
                [
                    'judul'      => 'Persetujuan dosen pembimbing',
                    'state'      => 'active',
                    'badge'      => 'Menunggu',
                    'badgeClass' => 'warning',
                ],
            ],
            'riwayat'     => [
                [
                    'nomor'      => 1,
                    'judul'      => 'Diskusi Awal Topik & Ruang Lingkup',
                    'state'      => 'done',
                    'badge'      => 'Disetujui',
                    'badgeClass' => 'success',
                ],
                [
                    'nomor'      => 2,
                    'judul'      => 'Bab I: Latar Belakang & Rumusan Masalah',
                    'state'      => 'done',
                    'badge'      => 'Disetujui',
                    'badgeClass' => 'success',
                ],
                [
                    'nomor'      => 3,
                    'judul'      => 'Bab II: Tinjauan Pustaka',
                    'state'      => 'done',
                    'badge'      => 'Disetujui',
                    'badgeClass' => 'success',
                ],
                [
                    'nomor'      => 4,
                    'judul'      => 'Bab III: Metodologi Penelitian',
                    'state'      => 'active',
                    'badge'      => 'Menunggu',
                    'badgeClass' => 'warning',
                ],
            ],
            'progress'    => 100,
        ];

        // Data for Skripsi (matching user screenshot)
        $skripsi = [
            'title'       => 'Bimbingan Skripsi',
            'statistik'   => [
                'sesi'      => '6 / 8',
                'disetujui' => 5,
                'menunggu'  => 1,
            ],
            'persyaratan' => [
                [
                    'judul'      => 'Minimal 8 sesi bimbingan',
                    'state'      => 'active',
                    'badge'      => 'Belum Terpenuhi',
                    'badgeClass' => 'warning',
                ],
                [
                    'judul'      => 'Persetujuan dosen pembimbing',
                    'state'      => '',
                    'badge'      => 'Menunggu',
                    'badgeClass' => 'neutral',
                ],
            ],
            'riwayat'     => [
                [
                    'nomor'      => 1,
                    'judul'      => 'Bab I Pendahuluan',
                    'state'      => 'done',
                    'badge'      => 'Disetujui',
                    'badgeClass' => 'success',
                ],
                [
                    'nomor'      => 2,
                    'judul'      => 'Bab II Tinjauan Pustaka',
                    'state'      => 'done',
                    'badge'      => 'Disetujui',
                    'badgeClass' => 'success',
                ],
                [
                    'nomor'      => 3,
                    'judul'      => 'Bab III Metodologi',
                    'state'      => 'done',
                    'badge'      => 'Disetujui',
                    'badgeClass' => 'success',
                ],
                [
                    'nomor'      => 4,
                    'judul'      => 'Bab IV Perancangan Sistem',
                    'state'      => 'done',
                    'badge'      => 'Disetujui',
                    'badgeClass' => 'success',
                ],
                [
                    'nomor'      => 5,
                    'judul'      => 'Bab V Implementasi',
                    'state'      => 'done',
                    'badge'      => 'Disetujui',
                    'badgeClass' => 'success',
                ],
                [
                    'nomor'      => 6,
                    'judul'      => 'Bab VI Pengujian dan Penutup',
                    'state'      => 'active',
                    'badge'      => 'Menunggu',
                    'badgeClass' => 'warning',
                ],
            ],
            'progress'    => 75,
        ];

        $this->load->view('views/bimbingan/index.php', [
            'pageTitle'  => 'Bimbingan',
            'activeMenu' => 'bimbingan',
            'sempro'     => $sempro,
            'skripsi'    => $skripsi,
        ]);
    }

    public function create()
    {
        $dosenList = [
            'Dr. Eng. Resbob, M.Kom.',
            'Dosen Pembimbing, M.T.',
            'Dosen Pembimbing 2, M.Cs.',
        ];

        $metodeList = [
            'Tatap Muka (Luring)',
            'Daring (Online / Video Conference)',
            'Asinkron (Email / Catatan Dokumen)',
        ];

        $programList = [
            'Skripsi',
            'Seminar Proposal',
        ];

        $this->load->view('views/bimbingan/form.php', [
            'pageTitle'   => 'Tambah Catatan Bimbingan',
            'activeMenu'  => 'bimbingan',
            'dosenList'   => $dosenList,
            'metodeList'  => $metodeList,
            'programList' => $programList,
        ]);
    }

    public function store()
    {
        header('Location: ' . BASE_URL . '/bimbingan');
        exit;
    }
}

