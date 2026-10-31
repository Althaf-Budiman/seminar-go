<?php


class Kalender
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
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];
        $t = strtotime($ymd);
        return $hari[(int)date('w', $t)] . ', ' . date('j', $t) . ' ' . $bulan[(int)date('n', $t)] . ' ' . date('Y', $t);
    }

    public function index()
    {
        // Data dummmy
        // status : 'selesai' | 'terkonfirmasi'
        // penguji: 1 | 2 (peran dosen yang login di sidang ini)
        $data = [
            [
                'id'       => 1,
                'tanggal'  => '2026-10-16',
                'mulai'    => '09.00',
                'selesai'  => '10.00',
                'nama'     => 'Muhammad Desra Zaidaan',
                'nim'      => '2207411017',
                'jenis'    => 'Seminar Proposal',
                'judul'    => 'Sistem Monitoring Kualitas Udara Berbasis Internet of Things',
                'ruang'    => 'Ruang Sidang 2',
                'penguji'  => 2,
                'status'   => 'selesai',
            ],
            [
                'id'       => 2,
                'tanggal'  => '2026-10-19',
                'mulai'    => '09.00',
                'selesai'  => '10.00',
                'nama'     => 'Sakha Ibadil Kirom',
                'nim'      => '2207411024',
                'jenis'    => 'Seminar Proposal',
                'judul'    => 'Sistem Informasi Pengelolaan Bank Sampah Berbasis Web',
                'ruang'    => 'Ruang Sidang 1',
                'penguji'  => 1,
                'status'   => 'terkonfirmasi',
            ],
            [
                'id'       => 3,
                'tanggal'  => '2026-10-19',
                'mulai'    => '13.00',
                'selesai'  => '14.00',
                'nama'     => 'Althaf',
                'nim'      => '2207411036',
                'jenis'    => 'Seminar Proposal',
                'judul'    => 'Penerapan Machine Learning untuk Prediksi Penjualan UMKM',
                'ruang'    => 'Ruang Sidang 2',
                'penguji'  => 2,
                'status'   => 'terkonfirmasi',
            ],
            [
                'id'       => 4,
                'tanggal'  => '2026-10-20',
                'mulai'    => '10.00',
                'selesai'  => '11.00',
                'nama'     => 'Fikri',
                'nim'      => '2207411008',
                'jenis'    => 'Sidang Skripsi',
                'judul'    => 'Perancangan UI/UX Aplikasi Layanan Kesehatan Kampus',
                'ruang'    => 'Ruang Sidang 1',
                'penguji'  => 1,
                'status'   => 'terkonfirmasi',
            ],
            [
                'id'       => 5,
                'tanggal'  => '2026-11-03',
                'mulai'    => '08.00',
                'selesai'  => '09.00',
                'nama'     => 'Rina Maharani',
                'nim'      => '2207411041',
                'jenis'    => 'Sidang Skripsi',
                'judul'    => 'Analisis Sentimen Ulasan Aplikasi Mobile Menggunakan Naive Bayes',
                'ruang'    => 'Ruang Sidang 3',
                'penguji'  => 2,
                'status'   => 'terkonfirmasi',
            ],
            [
                'id'       => 6,
                'tanggal'  => '2026-12-08',
                'mulai'    => '14.00',
                'selesai'  => '15.00',
                'nama'     => 'Dimas Prakoso',
                'nim'      => '2207411052',
                'jenis'    => 'Seminar Proposal',
                'judul'    => 'Rancang Bangun Sistem Presensi Berbasis Pengenalan Wajah',
                'ruang'    => 'Ruang Sidang 1',
                'penguji'  => 1,
                'status'   => 'terkonfirmasi',
            ],
        ];

        usort($data, function ($a, $b) {
            return strcmp($a['tanggal'] . $a['mulai'], $b['tanggal'] . $b['mulai']);
        });

        $jadwal = [];
        foreach ($data as $row) {
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

        $this->load->view('views/kalender/index.php', [
            'pageTitle' => 'Jadwal Seminar dan Sidang',
            'jadwal'    => $jadwal,
            'today'     => $today,
        ]);
    }
}