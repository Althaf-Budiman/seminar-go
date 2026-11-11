<?php

require_once __DIR__ . '/BaseModel.php';

class MahasiswaModel extends BaseModel
{
    protected $table = 'MAHASISWA';
    protected $primaryKey = 'mahasiswa_id';
    protected $fillable = ['identification_type', 'email', 'no_hp_orangtua', 'nama_orangtua', 'no_hp', 'program_studi', 'nama_lengkap', 'kelas', 'alamat', 'foto', 'tahun_akademik', 'mahasiswa_aktif', 'user_id', 'kelompok_id', 'dosen_id'];


    public function getByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM MAHASISWA WHERE user_id = ? LIMIT 1");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getWithRelations($mahasiswaId)
    {
        $sql = "SELECT m.*, u.identification_number, u.role, k.nama_kelompok, d.nama_lengkap AS nama_dosen, d.email AS email_dosen
                FROM MAHASISWA m
                JOIN `USER` u ON u.user_id = m.user_id
                LEFT JOIN KELOMPOK k ON k.kelompok_id = m.kelompok_id
                LEFT JOIN DOSEN d ON d.dosen_id = m.dosen_id
                WHERE m.mahasiswa_id = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$mahasiswaId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getByDosen($dosenId)
    {
        $stmt = $this->db->prepare("SELECT * FROM MAHASISWA WHERE dosen_id = ? ORDER BY nama_lengkap");
        $stmt->execute([$dosenId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActive()
    {
        $stmt = $this->db->query("SELECT * FROM MAHASISWA WHERE mahasiswa_aktif = 1 ORDER BY nama_lengkap");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
