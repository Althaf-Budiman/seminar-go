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
            'statusProposal' => 'Tahap Pengajuan Topik',
            'progres' => [
                'currentStep' => 1,
                'totalSteps' => 7,
                'steps' => [
                    [
                        'number' => 1,
                        'title' => 'Pengajuan Topik & Pembimbing',
                        'subtitle' => 'Proses Pengajuan & Penelaahan',
                        'status' => 'active',
                        'badgeText' => 'Tahap Aktif',
                    ],
                    [
                        'number' => 2,
                        'title' => 'Bimbingan Proposal',
                        'subtitle' => null,
                        'status' => 'locked',
                        'badgeText' => 'Terkunci',
                    ],
                    [
                        'number' => 3,
                        'title' => 'Kelengkapan Berkas Seminar Proposal',
                        'subtitle' => null,
                        'status' => 'locked',
                        'badgeText' => 'Terkunci',
                    ],
                    [
                        'number' => 4,
                        'title' => 'Jadwal Sidang',
                        'subtitle' => null,
                        'status' => 'locked',
                        'badgeText' => 'Terkunci',
                    ],
                    [
                        'number' => 5,
                        'title' => 'Sidang Seminar Proposal',
                        'subtitle' => null,
                        'status' => 'locked',
                        'badgeText' => 'Terkunci',
                    ],
                    [
                        'number' => 6,
                        'title' => 'Hasil Penilaian',
                        'subtitle' => null,
                        'status' => 'locked',
                        'badgeText' => 'Terkunci',
                    ],
                    [
                        'number' => 7,
                        'title' => 'Revisi Sempro',
                        'subtitle' => null,
                        'status' => 'conditional',
                        'badgeText' => 'Kondisional',
                    ],
                ]
            ],
            'detailProposal' => [
                'status' => 'Menunggu Review Topik',
                'judul' => 'Aplikasi Pencatatan Menu dan Kandungan Gizi untuk Pengelolaan Data MBG',
                'topik' => 'Sistem Informasi Kesehatan & Pemantauan Nutrisi Berbasis Web',
                'dosenPembimbing' => 'Belum Ditentukan (Menunggu Persetujuan Koordinator)',
                'nipPembimbing' => 'NIP. -',
                'ringkasan' => 'Sistem terintegrasi untuk mendata distribusi makanan bergizi, menghitung estimasi kecukupan makronutrien, dan pelaporan berkala secara terpusat untuk program intervensi gizi nasional.'
            ],
            'jadwalSempro' => null,
            'catatanBimbingan' => null,
            'pendaftaranDokumen' => null,
            'hasilPenilaian' => [
                'statusKalkulasi' => 'Dalam Proses Penilaian'
            ],
            'revisiSempro' => [
                'status' => 'Belum Ada Catatan Revisi'
            ]
        ];

        $this->load->view('views/beranda/index.php', $data);
    }
}

