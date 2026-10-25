<?php


class DokumenLogbook
{
    private $load;

    public function __construct()
    {
        $this->load  = new Loader();
    }

    public function index()
    {
        $logbooks = [
            [
                'id'             => 1,
                'jenis'          => 'Bimbingan Proposal',
                'file'           => 'Proposal_v6.pdf',
                'tanggal'        => '18 Okt 2026',
                'jam'            => '08.42 WIB',
                'nama_mahasiswa' => 'Nadia Putri Ramadhani',
                'nim'            => '2207411024',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
            [
                'id'             => 2,
                'jenis'          => 'Bimbingan Proposal',
                'file'           => 'Proposal_v5.pdf',
                'tanggal'        => '15 Okt 2026',
                'jam'            => '10.30 WIB',
                'nama_mahasiswa' => 'Nadia Putri Ramadhani',
                'nim'            => '2207411024',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
            [
                'id'             => 3,
                'jenis'          => 'Bimbingan Proposal',
                'file'           => 'Proposal_v4.pdf',
                'tanggal'        => '12 Okt 2026',
                'jam'            => '09.00 WIB',
                'nama_mahasiswa' => 'Nadia Putri Ramadhani',
                'nim'            => '2207411024',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
            [
                'id'             => 4,
                'jenis'          => 'Bimbingan Proposal',
                'file'           => 'Proposal_v3.pdf',
                'tanggal'        => '08 Okt 2026',
                'jam'            => '13.15 WIB',
                'nama_mahasiswa' => 'Nadia Putri Ramadhani',
                'nim'            => '2207411024',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
            [
                'id'             => 5,
                'jenis'          => 'Logbook Mingguan',
                'file'           => 'Logbook_W3.pdf',
                'tanggal'        => '05 Okt 2026',
                'jam'            => '11.00 WIB',
                'nama_mahasiswa' => 'Nadia Putri Ramadhani',
                'nim'            => '2207411024',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
            [
                'id'             => 6,
                'jenis'          => 'Logbook Mingguan',
                'file'           => 'Logbook_W2.pdf',
                'tanggal'        => '28 Sep 2026',
                'jam'            => '14.00 WIB',
                'nama_mahasiswa' => 'Nadia Putri Ramadhani',
                'nim'            => '2207411024',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
            [
                'id'             => 7,
                'jenis'          => 'Logbook Mingguan',
                'file'           => 'Logbook_W1.pdf',
                'tanggal'        => '21 Sep 2026',
                'jam'            => '09.30 WIB',
                'nama_mahasiswa' => 'Nadia Putri Ramadhani',
                'nim'            => '2207411024',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
            [
                'id'             => 8,
                'jenis'          => 'Bimbingan Proposal',
                'file'           => 'Proposal_v2.pdf',
                'tanggal'        => '14 Sep 2026',
                'jam'            => '10.00 WIB',
                'nama_mahasiswa' => 'Nadia Putri Ramadhani',
                'nim'            => '2207411024',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
            [
                'id'             => 9,
                'jenis'          => 'Bimbingan Proposal',
                'file'           => 'Proposal_v1.pdf',
                'tanggal'        => '07 Sep 2026',
                'jam'            => '08.00 WIB',
                'nama_mahasiswa' => 'Nadia Putri Ramadhani',
                'nim'            => '2207411024',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
            [
                'id'             => 10,
                'jenis'          => 'Logbook Mingguan',
                'file'           => 'Logbook_W0.pdf',
                'tanggal'        => '31 Agu 2026',
                'jam'            => '15.00 WIB',
                'nama_mahasiswa' => 'Nadia Putri Ramadhani',
                'nim'            => '2207411024',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
            [
                'id'             => 11,
                'jenis'          => 'Bimbingan Skripsi',
                'file'           => 'Skripsi_BAB1.pdf',
                'tanggal'        => '20 Agu 2026',
                'jam'            => '13.00 WIB',
                'nama_mahasiswa' => 'Nadia Putri Ramadhani',
                'nim'            => '2207411024',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
            [
                'id'             => 12,
                'jenis'          => 'Bimbingan Skripsi',
                'file'           => 'Skripsi_Outline.pdf',
                'tanggal'        => '10 Agu 2026',
                'jam'            => '11.30 WIB',
                'nama_mahasiswa' => 'Nadia Putri Ramadhani',
                'nim'            => '2207411024',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
        ];

        $this->load->view('views/dokumen-logbook/index.php', [
            'pageTitle' => 'Logbook',
            'logbooks'  => $logbooks,
        ]);
    }
}
