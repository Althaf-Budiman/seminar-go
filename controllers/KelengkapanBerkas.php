<?php

class KelengkapanBerkas
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
            'title'         => 'Kelengkapan Berkas Seminar Proposal',
            'berkas'        => [
                [
                    'id'         => 1,
                    'nama'       => 'Naskah Proposal (PDF)',
                    'uploaded'   => true,
                    'status'     => 'Terunggah',
                    'badgeClass' => 'success',
                    'state'      => 'done',
                ],
                [
                    'id'         => 2,
                    'nama'       => 'Lembar Persetujuan Dosen Pembimbing',
                    'uploaded'   => true,
                    'status'     => 'Terunggah',
                    'badgeClass' => 'success',
                    'state'      => 'done',
                ],
                [
                    'id'         => 3,
                    'nama'       => 'Bukti Bimbingan Minimal 3 Kali',
                    'uploaded'   => true,
                    'status'     => 'Menunggu Verifikasi',
                    'badgeClass' => 'warning',
                    'state'      => 'active',
                ],
                [
                    'id'         => 4,
                    'nama'       => 'Kartu Rencana Studi Semester Berjalan',
                    'uploaded'   => false,
                    'status'     => 'Belum Diunggah',
                    'badgeClass' => 'danger',
                    'state'      => 'locked',
                ],
            ],
            'jumlahLengkap' => 3,
            'progress'      => 75,
            'actionBtn'     => 'Ajukan Pendaftaran Sempro',
        ];

        // Data for Skripsi
        $skripsi = [
            'title'         => 'Kelengkapan Berkas Skripsi',
            'berkas'        => [
                [
                    'id'         => 1,
                    'nama'       => 'Naskah Skripsi (PDF)',
                    'uploaded'   => true,
                    'status'     => 'Terunggah',
                    'badgeClass' => 'success',
                    'state'      => 'done',
                ],
                [
                    'id'         => 2,
                    'nama'       => 'Lembar Persetujuan Dosen Pembimbing',
                    'uploaded'   => true,
                    'status'     => 'Terunggah',
                    'badgeClass' => 'success',
                    'state'      => 'done',
                ],
                [
                    'id'         => 3,
                    'nama'       => 'Bukti Bimbingan Minimal 8 Sesi',
                    'uploaded'   => true,
                    'status'     => 'Menunggu Verifikasi',
                    'badgeClass' => 'warning',
                    'state'      => 'active',
                ],
                [
                    'id'         => 4,
                    'nama'       => 'Bukti Pembayaran SPP',
                    'uploaded'   => false,
                    'status'     => 'Belum Diunggah',
                    'badgeClass' => 'danger',
                    'state'      => '',
                ],
                [
                    'id'         => 5,
                    'nama'       => 'Sertifikat Kompetensi',
                    'uploaded'   => false,
                    'status'     => 'Belum Diunggah',
                    'badgeClass' => 'danger',
                    'state'      => '',
                ],
            ],
            'jumlahLengkap' => 3,
            'progress'      => 60,
            'actionBtn'     => 'Ajukan Pendaftaran Sidang',
        ];

        $this->load->view('views/kelengkapan-berkas/index.php', [
            'pageTitle'    => 'Kelengkapan Berkas',
            'activeMenu'   => 'kelengkapan-berkas',
            'sempro'       => $sempro,
            'skripsi'      => $skripsi,
        ]);
    }
}
