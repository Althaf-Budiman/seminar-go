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
            'syarat_pendaftaran'        => [
                [
                    'id'         => 1,
                    'nama'       => 'Minimal 3 logbook disetujui',
                    'state'      => 'done',
                    'status'     => 'Terpenuhi',
                    'badgeClass' => 'success',
                ],
                [
                    'id'         => 2,
                    'status'     => 'Terpenuhi',
                    'badgeClass' => 'success',
                    'nama'       => 'Mahasiswa aktif semester berjalan',
                    'state'      => 'done',
                ],
            ],
            'berkas'        => [
                [
                    'id'         => 1,
                    'nama'       => 'Naskah Proposal (PDF)',
                    'uploaded'   => true,
                    'status'     => 'Terpenuhi',
                    'badgeClass' => 'success',
                    'state'      => 'done',
                ],
                [
                    'id'         => 2,
                    'nama'       => 'Form F1 Persetujuan Dosen Pembimbing',
                    'uploaded'   => true,
                    'status'     => 'Terpenuhi',
                    'badgeClass' => 'success',
                    'state'      => 'done',
                ],
            ],
            'jumlahLengkap' => 2,
        ];

        // Data for Skripsi
        $skripsi = [
            'syarat_pendaftaran'        => [
                [
                    'id'         => 1,
                    'nama'       => 'Minimal 10 logbook disetujui',
                    'state'      => 'done',
                    'status'     => 'Terpenuhi',
                    'badgeClass' => 'success',
                ],
                [
                    'id'         => 2,
                    'status'     => 'Terpenuhi',
                    'badgeClass' => 'success',
                    'nama'       => 'Mahasiswa aktif semester berjalan',
                    'state'      => 'done',
                ],
            ],
            'berkas'        => [
                [
                    'id'         => 1,
                    'nama'       => 'Laporan Skripsi (PDF)',
                    'uploaded'   => true,
                    'status'     => 'Terpenuhi',
                    'badgeClass' => 'success',
                    'state'      => 'done',
                ],
                [
                    'id'         => 2,
                    'nama'       => 'Form F4 Persetujuan Sidang Skripsi',
                    'uploaded'   => true,
                    'status'     => 'Terpenuhi',
                    'badgeClass' => 'success',
                    'state'      => 'done',
                ],
                [
                    'id'         => 3,
                    'nama'       => 'Sertifikat Lomba',
                    'uploaded'   => true,
                    'status'     => 'Menunggu Verifikasi',
                    'badgeClass' => 'warning',
                    'state'      => 'active',
                ],
            ],
            'jumlahLengkap' => 3,
            'progress'      => 60,
            'actionBtn'     => 'Ajukan Pendaftaran Sidang',
        ];

        $this->load->view('views/mahasiswa/kelengkapan-berkas/index.php', [
            'pageTitle'    => 'Kelengkapan Berkas',
            'activeMenu'   => 'kelengkapan-berkas',
            'sempro'       => $sempro,
            'skripsi'      => $skripsi,
        ]);
    }
}
