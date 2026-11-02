<?php


class Profil
{
    private $load;

    public function __construct()
    {
        $this->load = new Loader();
    }

    private function getProfile()
    {
        $user = $_SESSION['user'] ?? null;

        if (!$user) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $profile = $user['profile'] ?? [];

        $labelIdentitas = match ($user['role'] ?? '') {
            'mahasiswa' => 'NIM',
            default     => 'NIP',
        };

        return [
            'nama'    => $user['nama_lengkap'] ?? 'Pengguna',
            'role'    => ucfirst($user['role'] ?? 'User'),
            'label'   => $labelIdentitas,
            'nomor_identitas'   => $user['identification_number'] ?? '-',
            'prodi'   => $profile['prodi']
                ?? $profile['program_studi']
                ?? '-',
            'email'   => $profile['email'] ?? null,
            'no_hp' => $profile['no_hp'] ?? null,
            'alamat'  => $profile['alamat'] ?? '-',
            'foto'    => $profile['foto'] ?? null,
        ];
    }

    // GET 
    public function index()
    {
        $this->load->view('views/profil/index.php', ['pageTitle' => 'Profil', 'profile' => $this->getProfile()]);
    }

    // GET
    public function edit()
    {
        $this->load->view('views/profil/edit.php', [
            'pageTitle' => 'Edit Profil',
            'profil'    => $this->getProfile(),
        ]);
    }
}