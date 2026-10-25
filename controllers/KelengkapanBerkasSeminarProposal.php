
<?php

class KelengkapanBerkasSeminarProposal
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    public function index()
    {
        $berkas = [
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
        ];

        $jumlahLengkap = 3;
        $progress = (int) round(($jumlahLengkap / count($berkas)) * 100);

        $this->load->view(
            'views/kelengkapan-berkas-seminar-proposal/index.php',
            [
                'pageTitle'    => 'Kelengkapan Berkas Seminar Proposal',
                'activeMenu'   => 'kelengkapan-berkas-seminar-proposal',
                'berkas'       => $berkas,
                'jumlahLengkap'=> $jumlahLengkap,
                'progress'     => $progress,
            ]
        );
    }
}
