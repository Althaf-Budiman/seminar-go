
<?php

require_once __DIR__ . '/BaseModel.php';

class UserModel extends BaseModel
{
    protected $table = 'USER';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'identification_number',
        'password',
        'role'
    ];

    // Mengambil user berdasarkan NIM/NIP/username
    public function getByIdentificationNumber($identificationNumber)
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM `USER`
            WHERE identification_number = ?
            LIMIT 1
        ");
        $stmt->execute([$identificationNumber]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row === false ? null : $row;
    }

    // Mengambil profil berdasarkan role
    public function getProfile($userId, $role)
    {
        $tables = [
            'mahasiswa' => 'MAHASISWA',
            'dosen' => 'DOSEN',
            'admin' => 'ADMIN'
        ];

        if (!isset($tables[$role])) {
            return [];
        }

        $table = $tables[$role];

        $stmt = $this->db->prepare("
            SELECT *
            FROM `{$table}`
            WHERE user_id = ?
            LIMIT 1
        ");
        $stmt->execute([$userId]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row === false ? [] : $row;
    }

    // Menghitung jumlah mahasiswa
    public function countMahasiswa()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM MAHASISWA");
        return (int) $stmt->fetchColumn();
    }

    // Menghitung jumlah dosen
    public function countDosen()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM DOSEN");
        return (int) $stmt->fetchColumn();
    }

    // Mengambil seluruh user tanpa password
    public function getAll($limit = null, $offset = 0)
    {
        $sql = "
            SELECT user_id, identification_number, role
            FROM `USER`
            ORDER BY user_id ASC
        ";

        if ($limit !== null) {
            $sql .= " LIMIT " . max(1, (int) $limit)
                . " OFFSET " . max(0, (int) $offset);
        }

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil user berdasarkan ID tanpa password
    public function getById($id)
    {
        $stmt = $this->db->prepare("
            SELECT user_id, identification_number, role
            FROM `USER`
            WHERE user_id = ?
            LIMIT 1
        ");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row === false ? null : $row;
    }

    // Membuat user baru
    public function create($data)
    {
        $data = $this->filterData($data);

        if (
            empty($data['identification_number']) ||
            empty($data['password']) ||
            empty($data['role'])
        ) {
            throw new InvalidArgumentException('Data user belum lengkap.');
        }

        $data['password'] = password_hash(
            $data['password'],
            PASSWORD_DEFAULT
        );

        $stmt = $this->db->prepare("
            INSERT INTO `USER`
                (identification_number, password, role)
            VALUES (?, ?, ?)
        ");

        $stmt->execute([
            $data['identification_number'],
            $data['password'],
            $data['role']
        ]);

        return (int) $this->db->lastInsertId();
    }

    // Memperbarui data user
    public function update($id, $data)
    {
        $data = $this->filterData($data);

        if (empty($data)) {
            return false;
        }

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            );
        }

        return parent::update($id, $data);
    }

    // Memperbarui password
    public function updatePassword($userId, $newPassword)
    {
        $stmt = $this->db->prepare("
            UPDATE `USER`
            SET password = ?
            WHERE user_id = ?
        ");

        return $stmt->execute([
            password_hash($newPassword, PASSWORD_DEFAULT),
            $userId
        ]);
    }

    // Memverifikasi password
    public function verifyPassword($userId, $password)
    {
        $stmt = $this->db->prepare("
            SELECT password
            FROM `USER`
            WHERE user_id = ?
            LIMIT 1
        ");

        $stmt->execute([$userId]);
        $hash = $stmt->fetchColumn();

        return $hash !== false && password_verify($password, $hash);
    }
}
