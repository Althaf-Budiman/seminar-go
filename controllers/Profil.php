<?php


class Profil
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    // Data dummy.
    private function getProfil()
    {
        return [
            'nama'    => 'Si Mahasiswa',
            'nim'     => '2507411000',
            'prodi'   => 'Teknik Informatika',
            'email'   => 'simahasiswa.tik25@stu.pnj.ac.id',
            'telepon' => '+62 812-9840-2210',
            'alamat'  => 'Jl. G.A. Siwabesy',
            'foto'    => null, // path relatif, contoh: 'uploads/profil/2507411000.jpg'
        ];
    }

    // GET 
    public function index()
    {
        $this->load->view('views/profil/index.php', ['pageTitle' => 'Profil']);
    }

    // GET
    public function edit()
    {
        $this->load->view('views/profil/edit.php', [
            'pageTitle' => 'Edit Profil',
            'profil'    => $this->getProfil(),
        ]);
    }

    public function update()
    {
        $telepon = trim($_POST['telepon'] ?? '');
        $alamat  = trim($_POST['alamat'] ?? '');

        $isValid = preg_match('/^\+?[0-9\s-]{8,20}$/', $telepon)
            && $alamat !== ''
            && mb_strlen($alamat) <= 255;

        if (!$isValid) {
            // TODO: kirim pesan error (flash session) lalu tampilkan di form
            header('Location: ' . BASE_URL . '/profil/edit');
            exit;
        }

        // TODO: UPDATE telepon & alamat di database
        // TODO: proses $_FILES['foto']: cek MIME dengan finfo, batasi ukuran, ganti nama file

        header('Location: ' . BASE_URL . '/profil');
        exit;
    }
}