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
        // Data for Seminar Proposal
        $semproRevisi = [
            [
                'nomor'      => 1,
                'judul'      => 'Perjelas rumusan masalah pada Bab I',
            ],
            [
                'nomor'      => 2,
                'judul'      => 'Tambahkan perbandingan dengan penelitian terkait',
            ],
            [
                'nomor'      => 3,
                'judul'      => 'Perbaiki diagram alir sistem pada Bab III',
            ],
            [
                'nomor'      => 4,
                'judul'      => 'Jelaskan skenario pengujian dan metrik evaluasi',
            ],
            [
                'nomor'      => 5,
                'judul'      => 'Rapikan format sitasi sesuai standar IEEE',
            ],
        ];

        $semproPersetujuan = [
            [
                'nama'    => 'Dosen Ketua Sidang, M.Kom.',
                'status'  => 'Belum Diajukan',
            ],
            [
                'nama'    => 'Dosen Penguji 1, M.T.',
                'status'  => 'Belum Diajukan',
            ],
        ];

        $sempro = [
            'title'       => 'Revisi Seminar Proposal',
            'revisi'      => $semproRevisi,
            'persetujuan' => $semproPersetujuan,
            'statistik'   => [
                'total'        => count($semproRevisi),
                'batas'        => '12 Nov 2026',
                'sisaWaktu'    => '7 hari setelah seminar proposal',
            ],
        ];

        // Data for Skripsi
        $skripsiRevisi = [
            [
                'nomor'      => 1,
                'judul'      => 'Tambahkan analisis hasil load testing pada Bab V',
                'state'      => 'done',
                'badge'      => 'Selesai',
                'badgeClass' => 'success',
            ],
            [
                'nomor'      => 2,
                'judul'      => 'Lengkapi dokumen user guide dan lampiran source code',
                'state'      => 'done',
                'badge'      => 'Selesai',
                'badgeClass' => 'success',
            ],
            [
                'nomor'      => 3,
                'judul'      => 'Perbaiki arsitektur database relasional pada Bab IV',
                'state'      => 'done',
                'badge'      => 'Selesai',
                'badgeClass' => 'success',
            ],
            [
                'nomor'      => 4,
                'judul'      => 'Pertajam kesimpulan dan saran penelitian lanjutan pada Bab VI',
                'state'      => 'active',
                'badge'      => 'Dalam Proses',
                'badgeClass' => 'primary',
            ],
            [
                'nomor'      => 5,
                'judul'      => 'Lampirkan bukti kuesioner pengujian usability sistem',
                'state'      => 'locked',
                'badge'      => 'Belum',
                'badgeClass' => 'neutral',
            ],
        ];

        $skripsiPersetujuan = [
            [
                'nama'    => 'Dosen Ketua Sidang, M.Kom.',
                'status'  => 'Belum Diajukan',
            ],
            [
                'nama'    => 'Dosen Penguji 1, M.T.',
                'status'  => 'Belum Diajukan',
            ],
            [
                'nama'    => 'Dosen Penguji 2, M.Cs.',
                'status'  => 'Belum Diajukan',
            ],
            [
                'nama'    => 'Dosen Pembimbing, M.T.',
                'status'  => 'Belum Diajukan',
            ],
        ];

        $skripsi = [
            'title'       => 'Revisi Skripsi',
            'revisi'      => $skripsiRevisi,
            'persetujuan' => $skripsiPersetujuan,
            'statistik'   => [
                'total'        => count($skripsiRevisi),
                'selesai'      => count(array_filter($skripsiRevisi, fn ($i) => $i['state'] === 'done')),
                'belumSelesai' => count(array_filter($skripsiRevisi, fn ($i) => $i['state'] !== 'done')),
                'batas'        => '20 Nov 2026',
                'sisaWaktu'    => '14 hari setelah sidang skripsi',
            ],
        ];

        $this->load->view(
            'views/mahasiswa/revisi/index.php',
            [
                'pageTitle'  => 'Revisi',
                'activeMenu' => 'revisi',
                'sempro'     => $sempro,
                'skripsi'    => $skripsi,
            ]
        );
    }
}
