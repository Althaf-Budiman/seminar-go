<?php

class LogbookBimbingan
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    public function index()
    {
        global $page;
        $page = 'logbook-bimbingan';
        // Data for Seminar Proposal
        $sempro = [
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
            'title' => 'Bimbingan Skripsi',
            'statistik' => [
                'total' => 6,
                'disetujui' => 5,
                'menunggu' => 1,
            ],
            'persyaratan' => [
                [
                    'judul' => 'Minimal 10 logbook disetujui dosen pembimbing',
                    'state' => 'active',
                    'badge' => 'Belum Terpenuhi',
                    'badgeClass' => 'warning',
                ],
                [
                    'judul' => 'Persetujuan maju sidang dari dosen pembimbing',
                    'state' => '',
                    'badge' => 'Menunggu',
                    'badgeClass' => 'warning',
                ],
            ],
            'riwayat' => [
                [
                    'nomor' => 1,
                    'judul' => 'Bab I Pendahuluan',
                    'state' => 'done',
                    'badge' => 'Disetujui',
                    'badgeClass' => 'success',
                ],
                [
                    'nomor' => 2,
                    'judul' => 'Bab II Tinjauan Pustaka',
                    'state' => 'done',
                    'badge' => 'Disetujui',
                    'badgeClass' => 'success',
                ],
                [
                    'nomor' => 3,
                    'judul' => 'Bab III Metodologi',
                    'state' => 'done',
                    'badge' => 'Disetujui',
                    'badgeClass' => 'success',
                ],
                [
                    'nomor' => 4,
                    'judul' => 'Bab IV Perancangan Sistem',
                    'state' => 'done',
                    'badge' => 'Disetujui',
                    'badgeClass' => 'success',
                ],
                [
                    'nomor' => 5,
                    'judul' => 'Bab V Implementasi',
                    'state' => 'done',
                    'badge' => 'Disetujui',
                    'badgeClass' => 'success',
                ],
                [
                    'nomor' => 6,
                    'judul' => 'Bab VI Pengujian dan Penutup',
                    'state' => 'active',
                    'badge' => 'Menunggu',
                    'badgeClass' => 'warning',

                    'action' => true,
                ],
            ],
            'progress' => 50,
        ];

        $this->load->view('views/mahasiswa/logbook-bimbingan/index.php', [
            'pageTitle'  => 'Logbook Bimbingan',
            'activeMenu' => 'logbook-bimbingan',
            'sempro'     => $sempro,
            'skripsi'    => $skripsi,
        ]);
    }


    public function tambah()
    {
        global $page;
        $page = 'logbook-bimbingan-tambah';
        $program = $_GET['program'] ?? 'sempro';

        $user = $_SESSION['user'] ?? [];
        $profile = $user['profile'] ?? [];

        $identitas = [
            'judul_skripsi' => $profile['judul_skripsi'] ?? 'Aplikasi Pencatatan Menu dan Kandungan Gizi',
            'sub_judul' => $profile['sub_judul'] ?? 'Pengelolaan Data MBG',
            'nama_mahasiswa' => $profile['nama_lengkap'] ?? ($user['nama_lengkap'] ?? '—'),
            'nim' => $user['identification_number'] ?? '—',
            'program_studi' => $profile['program_studi'] ?? '—',
            'tahun_akademik' => $profile['tahun_akademik'] ?? '2026/2027',
        ];

        $this->load->view('views/mahasiswa/logbook-bimbingan/form.php', [
            'pageTitle' => 'Tambah Logbook',
            'activeMenu' => 'logbook-bimbingan',
            'program' => $program,
            'identitas' => $identitas,
        ]);
    }


    public function store()
    {
        header('Location: ' . BASE_URL . '/bimbingan');
        exit;
    }
}
