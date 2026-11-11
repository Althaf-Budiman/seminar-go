<?php

require_once __DIR__ . '/BaseModel.php';

class DosenPenilaianModel extends BaseModel
{
    protected $table = 'DOSEN_PENILAIAN';
    protected $primaryKey = 'dosen_penilaian_id';
    protected $fillable = ['komentar', 'total_nilai', 'role', 'dosen_id', 'penilaian_id'];


    public function getByPenilaian($penilaianId)
    {
        $stmt = $this->db->prepare(
            "SELECT dp.*, d.nama_lengkap, d.email
             FROM DOSEN_PENILAIAN dp
             JOIN DOSEN d ON d.dosen_id = dp.dosen_id
             WHERE dp.penilaian_id = ? ORDER BY dp.dosen_penilaian_id"
        );
        $stmt->execute([$penilaianId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByPair($penilaianId, $dosenId)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM DOSEN_PENILAIAN WHERE penilaian_id = ? AND dosen_id = ? LIMIT 1"
        );
        $stmt->execute([$penilaianId, $dosenId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
