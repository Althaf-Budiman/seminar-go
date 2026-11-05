<?php

require_once __DIR__ . '/../../models/UserModel.php';

class Login
{
    private $model;
    private $load;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->load  = new Loader();
    }

    private function validate($data)
    {
        $errors = [];

        if (empty(trim($data['identification_number'] ?? ''))) {
            $errors['identification_number'] = 'NIM / NIP / Username wajib diisi.';
        }
        if (empty(trim($data['password'] ?? ''))) {
            $errors['password'] = 'Password wajib diisi.';
        }

        return $errors;
    }

    public function index()
    {
        if (isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/beranda');
            exit;
        }

        $this->load->view('views/shared/login/index.php');
    }

    public function store()
    {
        $this->login();
    }

    public function login()
    {
        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $this->load->view('views/shared/login/index.php', [
                'errors' => $errors,
                'values' => $_POST
            ]);
            return;
        }

        $idNumber = trim($_POST['identification_number']);
        $user = $this->model->getByIdentificationNumber($idNumber);

        if (!$user) {
            $errors['login'] = 'NIM/NIP atau password salah.';

            $this->load->view('views/shared/login/index.php', [
                'errors' => $errors,
                'values' => $_POST
            ]);
            return;
        }

        if (!password_verify($_POST['password'], $user['password'])) {
            $errors['login'] = 'NIM/NIP atau password salah.';

            $this->load->view('views/shared/login/index.php', [
                'errors' => $errors,
                'values' => $_POST
            ]);
            return;
        }

        session_regenerate_id(true);

        $profile = $this->model->getProfile($user['user_id'], $user['role']);

        $_SESSION['user'] = [
            'user_id'               => $user['user_id'],
            'identification_number' => $user['identification_number'],
            'role'                  => $user['role'],
            'nama_lengkap'          => $profile['nama_lengkap'] ?? ucfirst($user['role']),
            'email'                 => $profile['email'] ?? ($user['role'] === 'admin' ? 'admin@stu.pnj.ac.id' : ''),
            'profile'               => $profile,
        ];

        header('Location: ' . BASE_URL . '/beranda');
        exit;
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
