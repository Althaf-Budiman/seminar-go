<?php


class DaftarMahasiswaBimbingan
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    private function getAllMahasiswa(): array
    {
        return [
            [
                'id'                    => 1,
                'nama'                  => 'Nadia Putri Ramadhani',
                'identification_number' => '2207411024',
                'tahap'                 => 'Bimbingan Proposal',
                'status'                => 'Berlangsung',
            ],
            [
                'id'                    => 2,
                'nama'                  => 'Si Mahasiswa',
                'identification_number' => '2207411027',
                'tahap'                 => 'Kelengkapan Berkas',
                'status'                => 'Berlangsung',
            ],
        ];
    }

    public function index()
    {
        $this->load->view('views/daftar-mahasiswa-bimbingan/index.php', [
            'pageTitle'  => 'Daftar Mahasiswa Bimbingan',
            'activeMenu' => 'daftar-mahasiswa-bimbingan',
            'mahasiswa'  => $this->getAllMahasiswa(),
        ]);
    }

    public function detail($id)
    {
        $allMahasiswa = $this->getAllMahasiswa();

        // Cari mahasiswa berdasarkan id
        $mahasiswa = null;
        foreach ($allMahasiswa as $mhs) {
            if ((int) $mhs['id'] === (int) $id) {
                $mahasiswa = $mhs;
                break;
            }
        }

        if (!$mahasiswa) {
            http_response_code(404);
            echo '404 - Mahasiswa tidak ditemukan';
            exit;
        }

        // Data logbook dummy per mahasiswa
        $logbookData = [
            1 => [
                [
                    'id'         => 1,
                    'topik'      => 'Diskusi Awal Topik & Ruang Lingkup',
                    'tanggal'    => 'Senin, 6 Oktober 2026',
                    'dosen'      => 'Dr. Eng. Resbob, M.Kom.',
                    'metode'     => 'Tatap Muka (Luring)',
                    'catatan'    => 'Mendiskusikan topik awal penelitian tentang sistem monitoring nutrisi berbasis web. Dosen memberikan saran untuk mempersempit ruang lingkup ke segmen pengguna tertentu.',
                    'lampiran'   => 'catatan_bimbingan_01.pdf',
                    'badge'      => 'Disetujui',
                    'badgeClass' => 'success',
                    'state'      => 'done',
                ],
                [
                    'id'         => 2,
                    'topik'      => 'Bab I: Latar Belakang & Rumusan Masalah',
                    'tanggal'    => 'Senin, 13 Oktober 2026',
                    'dosen'      => 'Dr. Eng. Resbob, M.Kom.',
                    'metode'     => 'Daring (Online / Video Conference)',
                    'catatan'    => 'Pembahasan draft Bab I. Perbaikan pada bagian rumusan masalah — lebih spesifik mengarah pada fitur rekomendasi berbasis content-based filtering.',
                    'lampiran'   => 'bab1_draft_v2.pdf',
                    'badge'      => 'Disetujui',
                    'badgeClass' => 'success',
                    'state'      => 'done',
                ],
                [
                    'id'         => 3,
                    'topik'      => 'Bab II: Tinjauan Pustaka',
                    'tanggal'    => 'Senin, 20 Oktober 2026',
                    'dosen'      => 'Dr. Eng. Resbob, M.Kom.',
                    'metode'     => 'Tatap Muka (Luring)',
                    'catatan'    => 'Review tinjauan pustaka. Dosen meminta penambahan referensi jurnal internasional (minimal 5 jurnal terindeks Scopus/WoS terbitan 5 tahun terakhir).',
                    'lampiran'   => 'bab2_draft_v1.pdf',
                    'badge'      => 'Disetujui',
                    'badgeClass' => 'success',
                    'state'      => 'done',
                ],
                [
                    'id'         => 4,
                    'topik'      => 'Bab III: Metodologi Penelitian',
                    'tanggal'    => 'Jumat, 31 Oktober 2026',
                    'dosen'      => 'Dr. Eng. Resbob, M.Kom.',
                    'metode'     => 'Daring (Online / Video Conference)',
                    'catatan'    => 'Pembahasan metodologi. Memerlukan perbaikan diagram alur sistem dan penjelasan algoritma yang digunakan.',
                    'lampiran'   => '',
                    'badge'      => 'Menunggu',
                    'badgeClass' => 'warning',
                    'state'      => 'active',
                ],
            ],
            2 => [
                [
                    'id'         => 5,
                    'topik'      => 'Konsultasi Kelengkapan Berkas',
                    'tanggal'    => 'Rabu, 22 Oktober 2026',
                    'dosen'      => 'Dr. Eng. Resbob, M.Kom.',
                    'metode'     => 'Tatap Muka (Luring)',
                    'catatan'    => 'Pemeriksaan kelengkapan dokumen persyaratan sidang. Masih terdapat 2 berkas yang belum dilengkapi.',
                    'lampiran'   => '',
                    'badge'      => 'Disetujui',
                    'badgeClass' => 'success',
                    'state'      => 'done',
                ],
            ],
        ];

        $logbook = $logbookData[(int) $id] ?? [];

        $this->load->view('views/daftar-mahasiswa-bimbingan/detail.php', [
            'pageTitle'  => 'Detail Mahasiswa - ' . $mahasiswa['nama'],
            'activeMenu' => 'daftar-mahasiswa-bimbingan',
            'mahasiswa'  => $mahasiswa,
            'logbook'    => $logbook,
        ]);
    }
}
