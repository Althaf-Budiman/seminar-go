<?php


class Notifikasi
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    public function index()
    {
        // Data dummy
        // icon : nama class Bootstrap Icons
        // waktu: label yang sudah diformat (relatif / tanggal)
        $notifikasi = [
            [
                'id'     => 1,
                'judul'  => 'Topik proposal disetujui',
                'pesan'  => 'Pengajuan topik kamu telah disetujui. Lanjutkan proses bimbingan proposal.',
                'waktu'  => '10 menit lalu',
                'icon'   => 'bi-check-lg',
                'dibaca' => false,
            ],
            [
                'id'     => 2,
                'judul'  => 'Catatan bimbingan baru',
                'pesan'  => 'Dosen Pembimbing, M.Kom. menambahkan catatan pada Bab II. Perbaiki landasan teori dan referensi.',
                'waktu'  => '35 menit lalu',
                'icon'   => 'bi-list',
                'dibaca' => false,
            ],
            [
                'id'     => 3,
                'judul'  => 'Jadwal seminar proposal tersedia',
                'pesan'  => 'Seminar kamu dijadwalkan pada 22 Oktober 2026, pukul 09.00 WIB di R. PUT TIK 3.',
                'waktu'  => '1 jam lalu',
                'icon'   => 'bi-calendar-event',
                'dibaca' => false,
            ],
            [
                'id'     => 4,
                'judul'  => 'Dokumen pendaftaran terverifikasi',
                'pesan'  => 'Seluruh berkas pendaftaran seminar proposal kamu dinyatakan lengkap oleh admin.',
                'waktu'  => 'Kemarin, 14.20',
                'icon'   => 'bi-check-lg',
                'dibaca' => true,
            ],
            [
                'id'     => 5,
                'judul'  => 'Hasil penilaian sudah tersedia',
                'pesan'  => 'Hasil seminar proposal telah dipublikasikan. Periksa catatan revisi dari dosen penguji.',
                'waktu'  => 'Kemarin, 10.15',
                'icon'   => 'bi-list',
                'dibaca' => true,
            ],
            [
                'id'     => 6,
                'judul'  => 'Pengingat batas waktu revisi',
                'pesan'  => 'Unggah naskah revisi beserta lembar persetujuan paling lambat 26 Oktober 2026.',
                'waktu'  => '17 Okt, 08.00',
                'icon'   => 'bi-clock',
                'dibaca' => true,
            ],
        ];

        $this->load->view('views/notifikasi/index.php', [
            'pageTitle'  => 'Notifikasi',
            'activeMenu' => 'notifikasi',
            'notifikasi' => $notifikasi,
        ]);
    }
}