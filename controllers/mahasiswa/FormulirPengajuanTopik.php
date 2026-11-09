
<?php

class FormulirPengajuanTopik
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    public function index()
    {
        $profile = $_SESSION['user']['profile'] ?? [];

        $programStudi = [
            'Teknik Informatika',
            'Teknik Multimedia dan Jaringan',
            'Teknik Komputer dan Jaringan',
        ];

        $kelas = [
            'TI-6A',
            'TI-6B',
            'TI-6C',
        ];

        $topikSkripsi = [
            'Rekayasa Perangkat Lunak',
            'Kecerdasan Buatan',
            'Sistem Informasi',
            'Jaringan dan Keamanan',
        ];

        $dosen = [
            ['dosen_id' => 1, 'nama_lengkap' => 'Pembimbing 1, M.Kom.'],
            ['dosen_id' => 2, 'nama_lengkap' => 'Pembimbing 2, M.Eng.'],
            ['dosen_id' => 3, 'nama_lengkap' => 'Pembimbing 3, M.T.'],
            ['dosen_id' => 4, 'nama_lengkap' => 'Pembimbing 4, M.Cs.'],
            ['dosen_id' => 5, 'nama_lengkap' => 'Pembimbing 5, M.Kom.'],
        ];

        $this->load->view('views/mahasiswa/formulir-pengajuan-topik/index.php', [
            'pageTitle' => 'Formulir Pengajuan Topik',
            'activeMenu' => 'formulir-topik',
            'mahasiswa' => [
                'email' => $profile['email'] ?? '',
                'no_hp' => $profile['no_hp'] ?? '',
                'nama_orangtua' => $profile['nama_orangtua'] ?? '',
                'no_hp_orangtua' => $profile['no_hp_orangtua'] ?? '',
                'program_studi' => $profile['program_studi'] ?? '',
                'kelas' => $profile['kelas'] ?? '',
            ],
            'programStudi' => $programStudi,
            'kelas' => $kelas,
            'topikSkripsi' => $topikSkripsi,
            'dosen' => $dosen,
        ]);
    }
}
