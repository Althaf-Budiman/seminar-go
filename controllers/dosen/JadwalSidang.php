<?php

class JadwalSidang
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    private function labelTanggal($ymd)
    {
        $hari  = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $t = strtotime($ymd);
        return $hari[(int)date('w', $t)] . ', ' . date('j', $t) . ' ' . $bulan[(int)date('n', $t)] . ' ' . date('Y', $t);
    }

    public function index()
    {
        $role = $_SESSION['user']['role'] ?? 'mahasiswa';

        if ($role === 'dosen') {
            $this->dosenJadwal();
            return;
        }

        // Data for Seminar Proposal (Mahasiswa)
        $sempro = [
            'title'        => 'Jadwal Seminar Proposal',
            'jadwal'       => [
                'status'  => 'Terkonfirmasi',
                'tanggal' => 'Rabu, 22 Oktober 2026',
                'waktu'   => '09.00 - 10.00 WIB',
                'link' => 'https://meet.google.com/abc-defg-hij',
                'mode'    => 'Daring',
            ],
            'dewanPenguji' => [
                [
                    'nama'       => 'Dosen Ketua Penguji, M.Kom.',
                    'peran'      => 'Ketua Penguji',
                ],
                [
                    'nama'       => 'Dosen Pembahas 1, M.T.',
                    'peran'      => 'Dosen Penguji',
                ],
                [
                    'nama'       => 'Dosen Pembimbing, M.T.',
                    'peran'      => 'Pembimbing',
                ],
            ],
            'btnUnduh'     => 'Unduh Undangan Seminar',
        ];

        // Data for Skripsi (Mahasiswa)
        $skripsi = [
            'title'        => 'Jadwal Sidang Skripsi',
            'subHeader'    => 'Jadwal Sidang Skripsi Anda',
            'jadwal'       => [
                'status'  => 'Terkonfirmasi',
                'tanggal' => 'Kamis, 5 November 2026',
                'waktu'   => '09.00 - 10.30 WIB',
                'ruangan' => 'Lab. Rekayasa Perangkat Lunak (Gd. TIK Lt. 3)',
                'mode'    => 'Luring (tatap muka)',
            ],
            'dewanPenguji' => [
                [
                    'nama'       => 'Dosen Ketua Sidang, M.Kom.',
                    'peran'      => 'Ketua Sidang',
                ],
                [
                    'nama'       => 'Dosen Penguji 1, M.T.',
                    'peran'      => 'Penguji 1',
                ],
                [
                    'nama'       => 'Dosen Penguji 2, M.Cs.',
                    'peran'      => 'Penguji 2',
                ],
                [
                    'nama'       => 'Dosen Pembimbing, M.T.',
                    'peran'      => 'Pembimbing',
                ],
            ],
        ];

        $this->load->view(
            'views/dosen/jadwal-sidang/index.php',
            [
                'pageTitle'    => 'Jadwal Sidang',
                'activeMenu'   => 'jadwal-sidang',
                'sempro'       => $sempro,
                'skripsi'      => $skripsi,
            ]
        );
    }

    private function dosenJadwal()
    {
        // Data jadwal pengujian untuk dosen
        $dataJadwal = [
            [
                'id'            => 1,
                'tanggal'       => '2026-10-16',
                'mulai'         => '09.00',
                'selesai'       => '10.00',
                'nama'          => 'Si Mahasiswa',
                'nim'           => '2207411017',
                'jenis'         => 'Seminar Proposal',
                'judul'         => 'Sistem Monitoring Kualitas Udara Berbasis Internet of Things',
                'ruang'         => 'R. PUT TIK 5',
                'penguji'       => 2,
                'status'        => 'selesai',
                'pembimbing'    => 'Dosen, M.T.',
                'dosen_penguji' => ['Dosen, M.Kom.', 'Dosen, M.Eng.'],
            ],
            [
                'id'            => 2,
                'tanggal'       => '2026-10-19',
                'mulai'         => '09.00',
                'selesai'       => '10.00',
                'nama'          => 'Si Mahasiswa',
                'nim'           => '2207411024',
                'jenis'         => 'Seminar Proposal',
                'judul'         => 'Sistem Informasi Pengelolaan Bank Sampah Berbasis Web',
                'ruang'         => 'R. PUT TIK 3',
                'penguji'       => 1,
                'status'        => 'terkonfirmasi',
                'pembimbing'    => 'Dosen, M.Kom.',
                'dosen_penguji' => ['Dosen, M.T.', 'Dosen, M.Eng.'],
            ],
            [
                'id'            => 3,
                'tanggal'       => '2026-10-19',
                'mulai'         => '13.00',
                'selesai'       => '14.00',
                'nama'          => 'Si Mahasiswa',
                'nim'           => '2207411036',
                'jenis'         => 'Seminar Proposal',
                'judul'         => 'Penerapan Machine Learning untuk Prediksi Penjualan UMKM',
                'ruang'         => 'R. PUT TIK 5',
                'penguji'       => 2,
                'status'        => 'terkonfirmasi',
                'pembimbing'    => 'Dosen, M.T.',
                'dosen_penguji' => ['Dosen, M.Kom.', 'Dosen, M.Eng.'],
            ],
            [
                'id'            => 4,
                'tanggal'       => '2026-10-20',
                'mulai'         => '10.00',
                'selesai'       => '11.00',
                'nama'          => 'Si Mahasiswa',
                'nim'           => '2207411008',
                'jenis'         => 'Sidang Skripsi',
                'judul'         => 'Perancangan UI/UX Aplikasi Layanan Kesehatan Kampus',
                'ruang'         => 'R. PUT TIK 3',
                'penguji'       => 1,
                'status'        => 'terkonfirmasi',
                'pembimbing'    => 'Dosen, M.Kom.',
                'dosen_penguji' => ['Dosen, M.T.', 'Dosen, M.Eng.'],
            ],
        ];

        usort($dataJadwal, function ($a, $b) {
            return strcmp($a['tanggal'] . $a['mulai'], $b['tanggal'] . $b['mulai']);
        });

        $jadwal = [];
        foreach ($dataJadwal as $row) {
            $tgl = $row['tanggal'];
            if (!isset($jadwal[$tgl])) {
                $jadwal[$tgl] = [
                    'label' => $this->labelTanggal($tgl),
                    'items' => [],
                ];
            }
            $jadwal[$tgl]['items'][] = $row;
        }

        $today = date('Y-m-d');

        $this->load->view('views/dosen/jadwal-sidang/dosen.php', [
            'pageTitle'  => 'Jadwal Seminar dan Sidang',
            'activeMenu' => 'jadwal-sidang',
            'jadwal'     => $jadwal,
            'today'      => $today,
        ]);
    }
}
