<?php

require_once __DIR__ . '/../config/database.php';

class UserModel
{
    private $db;

    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }

    public function getByIdentificationNumber($identificationNumber)
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM `USER`
            WHERE identification_number = ?
            LIMIT 1
        ");
        $stmt->execute([$identificationNumber]);
        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    public function getProfile($userId, $role)
    {
        if ($role === 'mahasiswa') {
            $stmt = $this->db->prepare("SELECT * FROM MAHASISWA WHERE user_id = ? LIMIT 1");
        } elseif ($role === 'dosen') {
            $stmt = $this->db->prepare("SELECT * FROM DOSEN WHERE user_id = ? LIMIT 1");
        } elseif ($role === 'admin') {
            $stmt = $this->db->prepare("SELECT * FROM ADMIN WHERE user_id = ? LIMIT 1");
        } else {
            return [];
        }

        $stmt->execute([$userId]);
        $row = $stmt->fetch();
        return $row === false ? [] : $row;
    }

    public function countMahasiswa()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM MAHASISWA");
        return (int) $stmt->fetchColumn();
    }

    public function countDosen()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM DOSEN");
        return (int) $stmt->fetchColumn();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT user_id, identification_number, role FROM `USER` ORDER BY user_id ASC");
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT user_id, identification_number, role FROM `USER` WHERE user_id = ? LIMIT 1");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO `USER` (identification_number, password, role) VALUES (?, ?, ?)");
        $stmt->execute([
            $data['identification_number'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['role'],
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        if (!empty($data['password'])) {
            $stmt = $this->db->prepare(
                "UPDATE `USER` SET identification_number = ?, password = ?, role = ? WHERE user_id = ?"
            );
            return $stmt->execute([
                $data['identification_number'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $data['role'],
                $id,
            ]);
        }

        $stmt = $this->db->prepare("UPDATE `USER` SET identification_number = ?, role = ? WHERE user_id = ?");
        return $stmt->execute([$data['identification_number'], $data['role'], $id]);
    }

    public function updatePassword($userId, $newPassword)
    {
        $stmt = $this->db->prepare("UPDATE `USER` SET password = ? WHERE user_id = ?");
        return $stmt->execute([password_hash($newPassword, PASSWORD_DEFAULT), $userId]);
    }

    public function verifyPassword($userId, $password)
    {
        $stmt = $this->db->prepare("SELECT password FROM `USER` WHERE user_id = ? LIMIT 1");
        $stmt->execute([$userId]);
        $hash = $stmt->fetchColumn();
        return $hash !== false && password_verify($password, $hash);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM `USER` WHERE user_id = ?");
        return $stmt->execute([$id]);
    }
}
