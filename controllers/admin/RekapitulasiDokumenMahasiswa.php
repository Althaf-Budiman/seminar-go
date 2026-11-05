<?php


class RekapitulasiDokumenMahasiswa
{
    private $load;

    public function __construct()
    {
        $this->load  = new Loader();
    }

    private function getPendaftaranMenungguVerifikasi()
    {
        return [
            [
                'nama' => "Fakhrul",
                'nim' => "2207411035",
                'jenis' => "Seminar Proposal",
            ],
            [
                'nama' => "Andrey",
                'nim' => "2207411036",
                'jenis' => "Sidang Skripsi",
            ],
        ];
    }

    public function index()
    {
        $documents = [
            [
                'id'             => 1,
                'jenis'          => 'Proposal Seminar',
                'file'           => 'Proposal_v6.pdf',
                'tanggal'        => '18 Okt 2026',
                'nama_mahasiswa' => 'Nadia Putri Ramadhani',
                'nim'            => '2207411024',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
            [
                'id'             => 2,
                'jenis'          => 'Lembar Persetujuan',
                'file'           => 'Proposal_v6.pdf',
                'tanggal'        => '19 Okt 2026',
                'nama_mahasiswa' => 'SI Mahasiswa',
                'nim'            => '2207411021',
                'prodi'          => 'Teknik Informatika',
                'kelas'          => 'TI 7A',
                'tahun_ajaran'   => '2026/2027',
            ],
        ];

        $this->load->view('views/admin/rekapitulasi-dokumen-mahasiswa/index.php', [
            'pageTitle' => 'Rekapitulasi Dokumen Mahasiswa',
            'documents'  => $documents,
            'pendaftaranMenungguVerifikasi' => $this->getPendaftaranMenungguVerifikasi()
        ]);
    }
}
