
<?php

class Sidang
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    public function index()
    {
        // State: done | active | locked
        $persiapan = [
            [
                'judul'      => 'Slide Presentasi',
                'state'      => 'done',
                'status'     => 'Siap',
                'badgeClass' => 'success',
            ],
            [
                'judul'      => 'Naskah Proposal Final',
                'state'      => 'done',
                'status'     => 'Siap',
                'badgeClass' => 'success',
            ],
            [
                'judul'      => 'Uji Coba Perangkat & Demo',
                'state'      => 'active',
                'status'     => 'Belum',
                'badgeClass' => 'warning',
            ],
            [
                'judul'      => 'Kelengkapan Berpakaian',
                'state'      => 'locked',
                'status'     => 'Belum',
                'badgeClass' => 'warning',
            ],
        ];

        // State active menandakan agenda yang sedang disorot.
        $susunanAcara = [
            [
                'judul' => 'Pembukaan oleh Ketua Sidang',
                'state' => '',
            ],
            [
                'judul' => 'Presentasi Mahasiswa',
                'state' => 'active',
            ],
            [
                'judul' => 'Tanya Jawab Dewan Penguji',
                'state' => '',
            ],
            [
                'judul' => 'Penilaian & Penutupan',
                'state' => '',
            ],
        ];

        $beritaAcara = [
            'status'     => 'Terkunci',
            'tersedia'   => false,
            'keterangan' => '',
        ];

        $jumlahSiap = count(array_filter(
            $persiapan,
            fn($item) => $item['state'] === 'done'
        ));

        $this->load->view(
            'views/sidang/index.php',
            [
                'pageTitle'    => 'Sidang',
                'activeMenu'   => 'sidang',
                'persiapan'    => $persiapan,
                'jumlahSiap'   => $jumlahSiap,
                'susunanAcara' => $susunanAcara,
                'beritaAcara'  => $beritaAcara,
            ]
        );
    }
}
