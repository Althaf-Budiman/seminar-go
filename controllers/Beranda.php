<?php

require_once __DIR__ . '/../models/UserModel.php';

class Beranda
{
    private $model;
    private $load;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->load  = new Loader();
    }

    public function index()
    {
        $role = $_SESSION['user']['role'] ?? 'mahasiswa';

        if ($role === 'admin') {
            $this->adminView();
        } elseif ($role === 'dosen') {
            $this->dosenView();
        } else {
            $this->mahasiswaView();
        }
    }

    private function adminView()
    {
        $data = [
            'pageTitle'      => 'Beranda',
            'adminName'      => $_SESSION['user']['nama_lengkap'] ?? 'Admin',
            'totalMahasiswa' => $this->model->countMahasiswa(),
            'totalDosen'     => $this->model->countDosen(),
            'kegiatanBulan'  => 18,
            'timeline'       => [
                ['step' => 1, 'title' => 'Pembuatan Akun',               'status' => 'Berlangsung', 'badge' => 'active'],
                ['step' => 2, 'title' => 'Pendaftaran Dosen Pembimbing', 'status' => 'Terjadwal',   'badge' => 'scheduled'],
                ['step' => 3, 'title' => 'Pendaftaran Seminar Proposal', 'status' => 'Menunggu',    'badge' => 'waiting'],
            ],
        ];

        $this->load->view('views/beranda/admin.php', $data);
    }

    private function dosenView()
    {
        $dosenTypeRaw = $_SESSION['user']['profile']['dosen_type'] ?? '';
        $dosenTypeLower = strtolower((string)$dosenTypeRaw);

        $isPembimbing = str_contains($dosenTypeLower, 'pembimbing');
        $isPenguji    = str_contains($dosenTypeLower, 'penguji');

        if (!$isPembimbing && !$isPenguji) {
            $isPembimbing = true;
            $isPenguji    = true;
        }

        $activeRole = $_SESSION['dosen_active_role'] ?? ($isPembimbing ? 'pembimbing' : 'penguji');
        if (!$isPembimbing) $activeRole = 'penguji';
        if (!$isPenguji)    $activeRole = 'pembimbing';

        if ($activeRole === 'penguji') {
            $this->dosenPengujiView();
        } else {
            $this->dosenPembimbingView();
        }
    }

    private function dosenPembimbingView()
    {
        $data = [
            'pageTitle'      => 'Beranda',
            'dosenRole'      => 'pembimbing',
            'dosenName'      => $_SESSION['user']['nama_lengkap'],
            'pendingLogbook' => 5,
            'pendingForm'    => 5,
            'timeline'       => [
                ['step' => 1, 'title' => 'Bimbingan Seminar Proposal', 'status' => 'Berlangsung', 'badge' => 'active'],
                ['step' => 2, 'title' => 'Seminar Proposal',           'status' => 'Terjadwal',   'badge' => 'scheduled'],
                ['step' => 3, 'title' => 'Penilaian Seminar Proposal', 'status' => 'Menunggu',    'badge' => 'waiting'],
            ],
        ];

        $this->load->view('views/beranda/dosen.php', $data);
    }

    private function dosenPengujiView()
    {
        $data = [
            'pageTitle'   => 'Beranda',
            'dosenRole'   => 'penguji',
            'dosenName'   => $_SESSION['user']['nama_lengkap'],
            'agendaUjian' => [
                [
                    'nama'    => 'Muhammad Desra Zaidaan',
                    'nim'     => '2207411017',
                    'jenis'   => 'Seminar Proposal',
                    'judul'   => 'Sistem Monitoring Kualitas Udara Berbasis Internet of Things',
                    'peran'   => 'Penguji 2',
                    'status'  => 'Selesai',
                    'tanggal' => 'Jumat, 16 Okt 2026',
                    'waktu'   => '09.00–10.00 WIB',
                    'ruang'   => 'R. PUT TIK 5',
                ],
                [
                    'nama'    => 'Sakha Ibadil Kirom',
                    'nim'     => '2207411024',
                    'jenis'   => 'Seminar Proposal',
                    'judul'   => 'Sistem Informasi Pengelolaan Bank Sampah Berbasis Web',
                    'peran'   => 'Penguji 1',
                    'status'  => 'Terkonfirmasi',
                    'tanggal' => 'Senin, 19 Okt 2026',
                    'waktu'   => '09.00–10.00 WIB',
                    'ruang'   => 'R. PUT TIK 3',
                ],
                [
                    'nama'    => 'Althaf',
                    'nim'     => '2207411036',
                    'jenis'   => 'Seminar Proposal',
                    'judul'   => 'Penerapan Machine Learning untuk Prediksi Penjualan UMKM',
                    'peran'   => 'Penguji 2',
                    'status'  => 'Terkonfirmasi',
                    'tanggal' => 'Senin, 19 Okt 2026',
                    'waktu'   => '13.00–14.00 WIB',
                    'ruang'   => 'R. PUT TIK 5',
                ],
                [
                    'nama'    => 'Si Mahasiswa',
                    'nim'     => '2207411008',
                    'jenis'   => 'Sidang Skripsi',
                    'judul'   => 'Perancangan UI/UX Aplikasi Layanan Kesehatan Kampus',
                    'peran'   => 'Penguji 1',
                    'status'  => 'Terkonfirmasi',
                    'tanggal' => 'Selasa, 20 Okt 2026',
                    'waktu'   => '10.00–11.00 WIB',
                    'ruang'   => 'R. PUT TIK 3',
                ],
            ],
            'timeline' => [
                ['step' => 1, 'title' => 'Jadwal Seminar Proposal',     'status' => 'Berlangsung', 'badge' => 'active'],
                ['step' => 2, 'title' => 'Pelaksanaan Sidang Proposal', 'status' => 'Terjadwal',   'badge' => 'scheduled'],
                ['step' => 3, 'title' => 'Input Nilai Penguji',         'status' => 'Menunggu',    'badge' => 'waiting'],
            ],
        ];

        $this->load->view('views/beranda/dosen.php', $data);
    }

    private function mahasiswaView()
    {
        $data = [
            'pageTitle' => 'Seminar Proposal',
            'sempro' => [
                'status'  => 'Tahap Pengajuan Topik',
                'progres' => [
                    'currentStep' => 1,
                    'totalSteps'  => 7,
                    'steps'       => [
                        [
                            'number'    => 1,
                            'title'     => 'Pengajuan Topik & Pembimbing',
                            'subtitle'  => 'Proses Pengajuan & Penelaahan',
                            'status'    => 'active',
                            'badgeText' => 'Tahap Aktif',
                        ],
                        [
                            'number'    => 2,
                            'title'     => 'Bimbingan Proposal',
                            'subtitle'  => null,
                            'status'    => 'locked',
                            'badgeText' => 'Terkunci',
                        ],
                        [
                            'number'    => 3,
                            'title'     => 'Kelengkapan Berkas Seminar Proposal',
                            'subtitle'  => null,
                            'status'    => 'locked',
                            'badgeText' => 'Terkunci',
                        ],
                        [
                            'number'    => 4,
                            'title'     => 'Jadwal Sidang',
                            'subtitle'  => null,
                            'status'    => 'locked',
                            'badgeText' => 'Terkunci',
                        ],
                        [
                            'number'    => 5,
                            'title'     => 'Sidang Seminar Proposal',
                            'subtitle'  => null,
                            'status'    => 'locked',
                            'badgeText' => 'Terkunci',
                        ],
                        [
                            'number'    => 6,
                            'title'     => 'Hasil Penilaian',
                            'subtitle'  => null,
                            'status'    => 'locked',
                            'badgeText' => 'Terkunci',
                        ],
                        [
                            'number'    => 7,
                            'title'     => 'Revisi Sempro',
                            'subtitle'  => null,
                            'status'    => 'conditional',
                            'badgeText' => 'Kondisional',
                        ],
                    ],
                ],
                'detailProposal' => [
                    'status'          => 'Menunggu Review Topik',
                    'judul'           => 'Aplikasi Pencatatan Menu dan Kandungan Gizi untuk Pengelolaan Data MBG',
                    'topik'           => 'Sistem Informasi Kesehatan & Pemantauan Nutrisi Berbasis Web',
                    'dosenPembimbing' => 'Belum Ditentukan (Menunggu Persetujuan Koordinator)',
                    'nipPembimbing'   => 'NIP. -',
                    'ringkasan'       => 'Sistem terintegrasi untuk mendata distribusi makanan bergizi, menghitung estimasi kecukupan makronutrien, dan pelaporan berkala secara terpusat untuk program intervensi gizi nasional.',
                ],
                'jadwal'             => null,
                'catatanBimbingan'   => null,
                'pendaftaranDokumen' => null,
                'hasilPenilaian'     => [
                    'statusKalkulasi' => 'Dalam Proses Penilaian',
                ],
                'revisi'             => [
                    'status' => 'Belum Ada Catatan Revisi',
                ],
            ],
            'skripsi' => [
                'judul'           => 'Aplikasi Pencatatan Menu dan Kandungan Gizi untuk Pengelolaan Data MBG',
                'dosenPembimbing' => 'Dr. Eng. Resbob, M.Kom.',
                'mahasiswa'       => 'Mahasiswa',
                'sesiTerpenuhi'   => 0,
                'totalSesi'       => 8,
                'steps'           => [
                    [
                        'number'    => 1,
                        'title'     => 'Bimbingan Skripsi',
                        'subtitle'  => null,
                        'status'    => 'active',
                        'badgeText' => 'Tahap Aktif',
                    ],
                    [
                        'number'    => 2,
                        'title'     => 'Kelengkapan Berkas Skripsi',
                        'subtitle'  => null,
                        'status'    => 'next',
                        'badgeText' => 'Berikutnya',
                    ],
                    [
                        'number'    => 3,
                        'title'     => 'Jadwal Sidang',
                        'subtitle'  => null,
                        'status'    => 'locked',
                        'badgeText' => 'Terkunci',
                    ],
                    [
                        'number'    => 4,
                        'title'     => 'Penilaian Penguji',
                        'subtitle'  => null,
                        'status'    => 'locked',
                        'badgeText' => 'Terkunci',
                    ],
                    [
                        'number'    => 5,
                        'title'     => 'Hasil Kelulusan',
                        'subtitle'  => null,
                        'status'    => 'locked',
                        'badgeText' => 'Terkunci',
                    ],
                ],
                'riwayatBimbingan'    => [],
                'pendaftaranTerkunci' => 'Lengkapi 2 sesi konsultasi tertulis dengan dosen pembimbing untuk membuka akses pengunggahan berkas pendaftaran sidang.',
                'jadwalSidang'        => null,
                'jadwalSidangInfo'    => 'Jadwal sidang akan ditentukan oleh koordinator sidang setelah pendaftaran skripsi disetujui dan seluruh penguji ditetapkan.',
                'hasilSidang'         => [
                    ['icon' => 'bi bi-person-badge', 'label' => 'Ketua Penguji',   'value' => 'Pending'],
                    ['icon' => 'bi bi-people',       'label' => 'Anggota Penguji', 'value' => 'Pending'],
                    ['icon' => 'bi bi-star',         'label' => 'Nilai',           'value' => 'Nilai belum keluar (-)'],
                ],
                'revisi'              => 'Revisi belum tersedia',
            ]
        ];

        $this->load->view('views/beranda/mahasiswa.php', $data);
    }
}
