
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
        $nilaiAkhir = 82.5;
        $predikat = 'A-';
        $keputusan = 'Lulus';
        $keteranganKeputusan = 'Dengan revisi minor';
        $labelKeputusan = 'Lulus dengan Revisi';

        $dewanPenguji = [
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
        ];

        $komponenPenilaian = [
            [
                'nama'  => 'Penguasaan materi',
                'nilai' => 85,
            ],
            [
                'nama'  => 'Kualitas naskah',
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
        ];

        $catatanUmum = 'Topik dinilai relevan dan layak dilanjutkan. Mahasiswa wajib memperbaiki rumusan masalah, diagram alir sistem, dan skenario pengujian sebelum tenggat revisi.';

        $this->load->view(
            'views/hasil-penilaian/index.php',
            [
                'pageTitle'              => 'Hasil Penilaian',
                'activeMenu'             => 'hasil-penilaian',
                'nilaiAkhir'              => $nilaiAkhir,
                'predikat'                => $predikat,
                'keputusan'               => $keputusan,
                'keteranganKeputusan'     => $keteranganKeputusan,
                'labelKeputusan'          => $labelKeputusan,
                'dewanPenguji'            => $dewanPenguji,
                'komponenPenilaian'       => $komponenPenilaian,
                'catatanUmum'             => $catatanUmum,
            ]
        );
    }
}
