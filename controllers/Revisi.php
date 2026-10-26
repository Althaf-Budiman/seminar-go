
<?php

class Revisi
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    public function index()
    {
        $revisi = [
            [
                'nomor' => 1,
                'judul' => 'Perjelas rumusan masalah pada Bab I',
                'state' => 'done',
                'badge' => 'Selesai',
                'badgeClass' => 'success',
            ],
            [
                'nomor' => 2,
                'judul' => 'Tambahkan perbandingan dengan penelitian terkait',
                'state' => 'done',
                'badge' => 'Selesai',
                'badgeClass' => 'success',
            ],
            [
                'nomor' => 3,
                'judul' => 'Perbaiki diagram alir sistem pada Bab III',
                'state' => 'active',
                'badge' => 'Dalam Proses',
                'badgeClass' => 'primary',
            ],
            [
                'nomor' => 4,
                'judul' => 'Jelaskan skenario pengujian dan metrik evaluasi',
                'state' => 'locked',
                'badge' => 'Belum',
                'badgeClass' => 'neutral',
            ],
            [
                'nomor' => 5,
                'judul' => 'Rapikan format sitasi sesuai standar IEEE',
                'state' => 'locked',
                'badge' => 'Belum',
                'badgeClass' => 'neutral',
            ],
        ];

        $persetujuan = [
            [
                'inisial' => 'K',
                'nama' => 'Dosen Ketua Sidang, M.Kom.',
                'status' => 'Belum Diajukan',
            ],
            [
                'inisial' => '1',
                'nama' => 'Dosen Penguji 1, M.T.',
                'status' => 'Belum Diajukan',
            ],
            [
                'inisial' => '2',
                'nama' => 'Dosen Penguji 2, M.Kom.',
                'status' => 'Belum Diajukan',
            ],
        ];

        $statistik = [
            'total' => count($revisi),
            'selesai' => count(array_filter(
                $revisi,
                fn($item) => $item['state'] === 'done'
            )),
            'belumSelesai' => count(array_filter(
                $revisi,
                fn($item) => $item['state'] !== 'done'
            )),
            'batas' => '12 Nov 2026',
            'sisaWaktu' => '7 hari setelah sidang',
        ];

        $this->load->view(
            'views/revisi/index.php',
            [
                'pageTitle' => 'Revisi',
                'activeMenu' => 'revisi',
                'statistik' => $statistik,
                'revisi' => $revisi,
                'persetujuan' => $persetujuan,
            ]
        );
    }
}
