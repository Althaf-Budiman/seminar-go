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

    public function update($id, $data)
    {
        // TODO
        // $stmt = $this->db->prepare(
        //     "UPDATE accounts
        //          SET name = ?, username = ?, email = ?, password = ?, account_type_id = ?, status = ?, identification_type = ?, identification_number = ?
        //          WHERE id = ?"
        // );
        // return $stmt->execute([
        //     $data['name'],
        //     $data['username'],
        //     $data['email'],
        //     password_hash($data['password'], PASSWORD_DEFAULT),
        //     $data['account_type_id'],
        //     $data['status'],
        //     $data['identification_type'],
        //     $data['identification_number'],
        //     $id,
        // ]);
    }
}
