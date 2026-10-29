<?php

class HasilPenilaian
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
            'predikat'            => 'A-',
            'keputusan'           => 'Lulus',
            'keteranganKeputusan' => 'Dengan revisi minor proposal',
            'labelKeputusan'      => 'Lulus dengan Revisi',
            'dewanPenguji'        => [
                [
                    'inisial' => 'K',
                    'nama'    => 'Dosen Ketua Sidang, M.Kom.',
                    'nilai'   => 84,
                ],
                [
                    'inisial' => '1',
                    'nama'    => 'Dosen Penguji 1, M.T.',
                    'nilai'   => 80,
                ],
                [
                    'inisial' => '2',
                    'nama'    => 'Dosen Penguji 2, M.Cs.',
                    'nilai'   => 83,
                ],
                [
                    'inisial' => 'P',
                    'nama'    => 'Dosen Pembimbing, M.T.',
                    'nilai'   => 83,
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
            'catatanUmum'         => 'Topik dinilai relevan dan layak dilanjutkan. Mahasiswa wajib memperbaiki rumusan masalah, diagram alir sistem, dan skenario pengujian sebelum tenggat revisi.',
            'btnUnduh'            => 'Unduh Berita Acara & Nilai Sempro',
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
                    'inisial' => 'K',
                    'nama'    => 'Dosen Ketua Sidang, M.Kom.',
                    'nilai'   => 88,
                ],
                [
                    'inisial' => '1',
                    'nama'    => 'Dosen Penguji 1, M.T.',
                    'nilai'   => 85,
                ],
                [
                    'inisial' => '2',
                    'nama'    => 'Dosen Penguji 2, M.Cs.',
                    'nilai'   => 86,
                ],
                [
                    'inisial' => 'P',
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
            'catatanUmum'         => 'Sistem dan pengujian telah diselesaikan dengan memuaskan. Mahasiswa wajib melengkapi lampiran pengujian beban dan dokumentasi API sebelum pengumpulan naskah final.',
            'btnUnduh'            => 'Unduh Lembar Hasil Penilaian Skripsi',
        ];

        $this->load->view(
            'views/hasil-penilaian/index.php',
            [
                'pageTitle'    => 'Hasil Penilaian',
                'activeMenu'   => 'hasil-penilaian',
                'sempro'       => $sempro,
                'skripsi'      => $skripsi,
            ]
        );
    }
}
