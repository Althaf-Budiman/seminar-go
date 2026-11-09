<?php

require_once __DIR__ . '/../../models/UserModel.php';

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

        $this->load->view('views/shared/beranda/admin.php', $data);
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

        $this->load->view('views/shared/beranda/dosen.php', $data);
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
        ];

        $this->load->view('views/shared/beranda/dosen.php', $data);
    }

    private function getProgressAnggotaKelompok(): array
    {
        // $profile = $_SESSION['user']['profile'] ?? [];
        // $kelompokId = $profile['kelompok_id'] ?? null;

        // if (empty($kelompokId)) {
        //     return [];
        // }

        // Data dummy untuk slicing.
        return [
            [
                'nama' => 'Sakha Ibadil Kirom',
                'nim' => '2207411024',
                'tahap' => 'Logbook Bimbingan',
                'tahapSelesai' => 2,
                'totalTahap' => 6,
                'status' => 'Dalam Proses',
                'badgeClass' => 'primary',
            ],
            [
                'nama' => 'Althaf',
                'nim' => '2207411036',
                'tahap' => 'Pengajuan Topik & Pembimbing',
                'tahapSelesai' => 1,
                'totalTahap' => 6,
                'status' => 'Dalam Proses',
                'badgeClass' => 'warning',
            ],
        ];
    }

    private function mahasiswaView()
    {
        $data = [
            'pageTitle' => 'Seminar Proposal',
            'sempro' => [
                'status'  => 'Tahap Pengajuan Topik',
                'anggotaKelompok' => $this->getProgressAnggotaKelompok(),
                'progress' => [
                    'currentStep' => 1,
                    'totalSteps'  => 7,
                    'steps'       => [
                        [
                            'number'    => 1,
                            'title'     => 'Pengajuan Topik & Pembimbing',
                            'status'    => 'active',
                            'badgeText' => 'Tahap Aktif',
                        ],
                        [
                            'number'    => 2,
                            'title'     => 'Lohgbook Bimbingan',
                            'status'    => 'locked',
                            'badgeText' => 'Terkunci',
                        ],
                        [
                            'number'    => 3,
                            'title'     => 'Kelengkapan Berkas',
                            'status'    => 'locked',
                            'badgeText' => 'Terkunci',
                        ],
                        [
                            'number'    => 4,
                            'title'     => 'Jadwal Sidang Seminar Proposal',
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
                            'title'     => 'Revisi Seminar Proposal (Kondisional)',
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
                'hasilSidang'     => null,
                'revisi'             => null,
                'kalender' => [
                    [
                        'judul' => 'Pengajuan Dosen Pembimbing',
                        'tanggal_mulai' => '2026-10-19',
                        'tanggal_selesai' => '2026-10-20',
                        'periode' => '19 Oktober 08.00 - 20 Oktober 08.00',
                        'jenis' => 'Pengajuan',
                    ],
                    [
                        'judul' => 'Bimbingan Seminar Proposal',
                        'tanggal_mulai' => '2026-10-16',
                        'tanggal_selesai' => '2026-10-16',
                        'periode' => '16 Oktober 09.00 - 10.00',
                        'jenis' => 'Bimbingan',
                    ],
                    [
                        'judul' => 'Seminar Proposal',
                        'tanggal_mulai' => '2026-10-10',
                        'tanggal_selesai' => '2026-10-10',
                        'periode' => '10 Oktober 10.00 - 11.00',
                        'jenis' => 'Sidang',
                    ],
                ],
            ],
            'skripsi' => [
                'judul'           => 'Aplikasi Pencatatan Menu dan Kandungan Gizi untuk Pengelolaan Data MBG',
                'dosenPembimbing' => 'Dr. Eng. Resbob, M.Kom.',
                'mahasiswa'       => 'Mahasiswa',
                'logbookDisetujui'   => 0,
                'totalPersetujuan'       => 8,
                'anggotaKelompok' => $this->getProgressAnggotaKelompok(),
                'steps'           => [
                    [
                        'number'    => 1,
                        'title'     => 'Logbook Bimbingan',
                        'status'    => 'active',
                        'badgeText' => 'Tahap Aktif',
                    ],
                    [
                        'number'    => 2,
                        'title'     => 'Kelengkapan Berkas Skripsi',
                        'status'    => 'next',
                        'badgeText' => 'Berikutnya',
                    ],
                    [
                        'number'    => 3,
                        'title'     => 'Jadwal Sidang Skripsi',
                        'status'    => 'locked',
                        'badgeText' => 'Terkunci',
                    ],
                    [
                        'number'    => 4,
                        'title'     => 'Sidang Skripsi',
                        'status'    => 'locked',
                        'badgeText' => 'Terkunci',
                    ],
                    [
                        'number'    => 5,
                        'title'     => 'Revisi Skripsi (Kondisional)',
                        'subtitle'  => null,
                        'status'    => 'locked',
                        'badgeText' => 'Terkunci',
                    ],
                ],
                'jadwal'             => null,
                'catatanBimbingan'   => null,
                'pendaftaranDokumen' => null,
                'hasilSidang'     => null,
                'revisi'             => null,
            ],
            'today' => date('Y-m-d'),

        ];

        $this->load->view('views/shared/beranda/mahasiswa.php', $data);
    }
}
