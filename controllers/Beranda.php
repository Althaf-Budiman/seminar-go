<?php


class Beranda
{
    private $load;

    public function __construct()
    {
        $this->load  = new Loader();
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Seminar Proposal',
            'sempro' => [
                'status'            => 'Tahap Pengajuan Topik',
                'progres'           => [
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
                'detailProposal'    => [
                    'status'          => 'Menunggu Review Topik',
                    'judul'           => 'Aplikasi Pencatatan Menu dan Kandungan Gizi untuk Pengelolaan Data MBG',
                    'topik'           => 'Sistem Informasi Kesehatan & Pemantauan Nutrisi Berbasis Web',
                    'dosenPembimbing' => 'Belum Ditentukan (Menunggu Persetujuan Koordinator)',
                    'nipPembimbing'   => 'NIP. -',
                    'ringkasan'       => 'Sistem terintegrasi untuk mendata distribusi makanan bergizi, menghitung estimasi kecukupan makronutrien, dan pelaporan berkala secara terpusat untuk program intervensi gizi nasional.',
                ],
                'jadwal'            => null,
                'catatanBimbingan'  => null,
                'pendaftaranDokumen'=> null,
                'hasilPenilaian'    => [
                    'statusKalkulasi' => 'Dalam Proses Penilaian',
                ],
                'revisi'            => [
                    'status' => 'Belum Ada Catatan Revisi',
                ],
            ],
            'skripsi' => [
                'judul'              => 'Aplikasi Pencatatan Menu dan Kandungan Gizi untuk Pengelolaan Data MBG',
                'dosenPembimbing'    => 'Dr. Eng. Resbob, M.Kom.',
                'mahasiswa'          => 'Mahasiswa',
                'sesiTerpenuhi'      => 0,
                'totalSesi'          => 8,
                'steps'              => [
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
                'riwayatBimbingan'   => [],
                'pendaftaranTerkunci'=> 'Lengkapi 2 sesi konsultasi tertulis dengan dosen pembimbing untuk membuka akses pengunggahan berkas pendaftaran sidang.',
                'jadwalSidang'       => null,
                'jadwalSidangInfo'   => 'Jadwal sidang akan ditentukan oleh koordinator sidang setelah pendaftaran skripsi disetujui dan seluruh penguji ditetapkan.',
                'hasilSidang'        => [
                    ['icon' => 'bi bi-person-badge', 'label' => 'Ketua Penguji',  'value' => 'Pending'],
                    ['icon' => 'bi bi-people',       'label' => 'Anggota Penguji','value' => 'Pending'],
                    ['icon' => 'bi bi-star',         'label' => 'Nilai',          'value' => 'Nilai belum keluar (-)'],
                ],
                'revisi'             => 'Revisi belum tersedia',
            ]
        ];

        $this->load->view('views/beranda/index.php', $data);
    }
}

