
<?php

class NilaiDanRevisi
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    private function getMahasiswa(): array
    {
        return [
            ['id' => 1, 'nama' => 'Si Mahasiswa', 'foto' => '👤'],
            ['id' => 2, 'nama' => 'Si Bro', 'foto' => '👤'],
            ['id' => 3, 'nama' => 'Si Men', 'foto' => '👤'],
            ['id' => 4, 'nama' =>'Si Mate', 'foto' => '👤'],
            ['id' => 5, 'nama' =>'Si Mahasiswa', 'foto' => '👤'],
            ['id' => 6, 'nama' =>'Si Mahasiswa', 'foto' => '👤'],
            ['id' => 7, 'nama' =>'Si Mahasiswa', 'foto' => '👤'],
            ['id' => 8, 'nama' =>'Si Mahasiswa', 'foto' => '👤'],
            ['id' => 9, 'nama' =>'Si Mahasiswa', 'foto' => '👤'],
            ['id' => 10, 'nama' =>'Si Mahasiswa', 'foto' => '👤'],
        ];
    }

    private function getMahasiswaDetail($id): ?array
    {
        $mahasiswa = [
            1 => [
                'id' => 1,
                'nama' => 'Si Mahasiswa',
                'nim' => '2507411041',
                'program_studi' => 'Teknik Informatika',
                'kelas' => 'TI 3A',
                'judul_skripsi' => 'Sistem Informasi Manajemen Data',
                'foto' => null,
            ],
            2 => [
                'id' => 2,
                'nama' => 'Si Bro',
                'nim' => '2507411042',
                'program_studi' => 'Teknik Informatika',
                'kelas' => 'TI 3A',
                'judul_skripsi' => 'Pengembangan Aplikasi Berbasis Web',
                'foto' => null,
            ],
        ];

        return $mahasiswa[(int) $id] ?? null;
    }

    private function getNilaiDummy(): array
    {
        return [
            'A1' => 8,
            'A2' => 13,
            'A3' => 8,
            'B1' => 13,
            'B2' => 8,
            'B3' => 8,
            'B4' => 13,
            'C1' => 3.5,
            'C2' => 3.5,
            'C3' => 2.5,
            'C4' => 3.5,
        ];
    }

    public function index()
    {
        $this->load->view('views/dosen/nilai-dan-revisi/index.php', [
            'pageTitle' => 'Nilai dan Revisi',
            'activeMenu' => 'nilai-dan-revisi',
            'mahasiswa' => $this->getMahasiswa(),
        ]);
    }

    public function tambah($id = null)
    {
        $mahasiswaDetail = $id !== null
            ? $this->getMahasiswaDetail($id)
            : null;

        if ($id !== null && !$mahasiswaDetail) {
            header('Location: ' . BASE_URL . '/nilai-dan-revisi');
            exit;
        }

        $this->load->view('views/dosen/nilai-dan-revisi/detail.php', [
            'pageTitle' => 'Tambah Nilai Skripsi',
            'activeMenu' => 'nilai-dan-revisi',
            'mahasiswaDetail' => $mahasiswaDetail ?? [],
            'nilai' => [],
            'catatanRevisi' => '',
            'mode' => 'create',
        ]);
    }

  
    public function detail($id)
    {
        $mahasiswaDetail = $this->getMahasiswaDetail($id);

        if (!$mahasiswaDetail) {
            header('Location: ' . BASE_URL . '/nilai-dan-revisi');
            exit;
        }

        $this->load->view('views/dosen/nilai-dan-revisi/detail.php', [
            'pageTitle' => 'Rekap Nilai Mahasiswa',
            'activeMenu' => 'nilai-dan-revisi',
            'mahasiswaDetail' => $mahasiswaDetail,
            'nilai' => $this->getNilaiDummy(),
            'catatanRevisi' => "1. Perbaiki konsistensi format sitasi dan daftar pustaka.\n2. Lengkapi skenario pengujian aplikasi pada Bab IV.\n3. Sesuaikan kesimpulan dengan hasil pengujian dan tujuan penelitian.",
            'mode' => 'detail',
        ]);
    }

    /**
     * Edit nilai skripsi.
     */
    public function edit($id)
    {
        $mahasiswaDetail = $this->getMahasiswaDetail($id);

        if (!$mahasiswaDetail) {
            header('Location: ' . BASE_URL . '/nilai-dan-revisi');
            exit;
        }

        $this->load->view('views/dosen/nilai-dan-revisi/detail.php', [
            'pageTitle' => 'Edit Nilai Skripsi',
            'activeMenu' => 'nilai-dan-revisi',
            'mahasiswaDetail' => $mahasiswaDetail,
            'nilai' => $this->getNilaiDummy(),
            'catatanRevisi' => "1. Perbaiki konsistensi format sitasi dan daftar pustaka.\n2. Lengkapi skenario pengujian aplikasi pada Bab IV.\n3. Sesuaikan kesimpulan dengan hasil pengujian dan tujuan penelitian.",
            'mode' => 'edit',
        ]);
    }
}
