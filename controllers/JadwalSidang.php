
<?php

class JadwalSidang
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    public function index()
    {
        $jadwal = [
            'status'  => 'Terkonfirmasi',
            'tanggal' => 'Kamis, 5 November 2026',
            'waktu'   => '09.00 - 10.00 WIB',
            'ruangan' => 'Lab. Rekayasa Perangkat Lunak (Gd. TIK Lt. 3)',
            'mode'    => 'Luring (tatap muka)',
        ];

        $dewanPenguji = [
            [
                'inisial'   => 'K',
                'nama'      => 'Dosen Ketua Sidang, M.Kom.',
                'peran'     => 'Ketua Sidang',
                'state'     => 'active',
                'badgeClass' => 'primary',
            ],
            [
                'inisial'   => '1',
                'nama'      => 'Dosen Penguji 1, M.T.',
                'peran'     => 'Penguji 1',
                'state'     => '',
                'badgeClass' => 'neutral',
            ],
            [
                'inisial'   => '2',
                'nama'      => 'Dosen Penguji 2, M.Cs.',
                'peran'     => 'Penguji 2',
                'state'     => '',
                'badgeClass' => 'neutral',
            ],
            [
                'inisial'   => 'P',
                'nama'      => 'Dosen Pembimbing, M.T.',
                'peran'     => 'Pembimbing',
                'state'     => '',
                'badgeClass' => 'neutral',
            ],
        ];

        $this->load->view(
            'views/jadwal-sidang/index.php',
            [
                'pageTitle'    => 'Jadwal Sidang',
                'activeMenu'   => 'jadwal-sidang',
                'jadwal'       => $jadwal,
                'dewanPenguji' => $dewanPenguji,
            ]
        );
    }
}
