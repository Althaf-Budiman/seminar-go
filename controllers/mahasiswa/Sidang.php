<?php

class Sidang
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
            'title'               => 'Hasil Penilaian Seminar Proposal',
            'nilaiAkhir'          => 82.5,
            'keputusan'           => 'Lulus',
            'keteranganKeputusan' => 'Dengan revisi minor proposal',
            'labelKeputusan'      => 'Lulus dengan Revisi',
            'dewanPenguji' => [
                [
                    'nama'       => 'Dosen Ketua Penguji, M.Kom.',
                    'peran'      => 'Ketua Penguji',
                    'nilai'   => 84,
                ],
                [
                    'nama'       => 'Dosen Pembahas 1, M.T.',
                    'peran'      => 'Dosen Penguji',
                    'nilai'   => 84,
                ],
                [
                    'nama'       => 'Dosen Pembimbing, M.T.',
                    'peran'      => 'Pembimbing',
                    'nilai'   => 84,
                ],
            ],
            'komponenPenilaian'   => [
                [
                    'nama'  => 'Penguasaan materi',
                    'nilai' => 85,
                ],
                [
                    'nama'  => 'Kualitas naskah proposal',
                    'nilai' => 80,
                ],
                [
                    'nama'  => 'Presentasi & tanya jawab',
                    'nilai' => 82,
                ],
                [
                    'nama'  => 'Kesesuaian metodologi',
                    'nilai' => 83,
                ],
            ],
            'jadwal'       => [
                'status'  => 'Terkonfirmasi',
                'tanggal' => 'Rabu, 22 Oktober 2026',
                'waktu'   => '09.00 - 10.00 WIB',
                'link' => 'https://meet.google.com/abc-defg-hij',
                'mode'    => 'Daring',
            ],
            'catatanUmum'         => 'Topik dinilai relevan dan layak dilanjutkan. Mahasiswa wajib memperbaiki rumusan masalah, diagram alir sistem, dan skenario pengujian sebelum tenggat revisi.',
        ];

        // Data for Skripsi
        $skripsi = [
            'title'               => 'Hasil Penilaian Skripsi',
            'nilaiAkhir'          => 86.0,
            'predikat'            => 'A',
            'keputusan'           => 'Lulus',
            'keteranganKeputusan' => 'Dengan revisi minor skripsi',
            'labelKeputusan'      => 'Lulus dengan Revisi Minor',
            'dewanPenguji'        => [
                [
                    'nama'    => 'Dosen Ketua Sidang, M.Kom.',
                    'nilai'   => 88,
                ],
                [
                    'nama'    => 'Dosen Penguji 1, M.T.',
                    'nilai'   => 85,
                ],
                [
                    'nama'    => 'Dosen Penguji 2, M.Cs.',
                    'nilai'   => 86,
                ],
                [
                    'nama'    => 'Dosen Pembimbing, M.T.',
                    'nilai'   => 85,
                ],
            ],
            'komponenPenilaian'   => [
                [
                    'nama'  => 'Penguasaan naskah skripsi',
                    'nilai' => 88,
                ],
                [
                    'nama'  => 'Implementasi sistem / produk',
                    'nilai' => 90,
                ],
                [
                    'nama'  => 'Presentasi & tanya jawab',
                    'nilai' => 84,
                ],
                [
                    'nama'  => 'Kesesuaian metodologi & analisis',
                    'nilai' => 82,
                ],
            ],
            'catatanUmum'         => 'Mahasiswa dinyatakan lulus sidang skripsi dengan revisi, revisi wajib diselesaikan sebelum tenggat revisi.',
        ];

        $this->load->view(
            'views/mahasiswa/sidang/index.php',
            [
                'pageTitle'    => 'Sidang',
                'activeMenu'   => 'sidang',
                'sempro'       => $sempro,
                'skripsi'      => $skripsi,
            ]
        );
    }
}
