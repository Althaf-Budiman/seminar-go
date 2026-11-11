<?php

require_once __DIR__ . '/BaseModel.php';

class PersetujuanRevisiModel extends BaseModel
{
    protected $table = 'PERSETUJUAN_REVISI';
    protected $primaryKey = 'persetujuan_revisi';
    protected $fillable = ['status', 'komentar', 'tanggal_diajukan', 'tanggal_respons', 'revisi_id', 'dosen_id'];


    public function getByRevisi($revisiId)
    {
        $stmt = $this->db->prepare(
            "SELECT pr.*, d.nama_lengkap AS nama_dosen
             FROM PERSETUJUAN_REVISI pr
             JOIN DOSEN d ON d.dosen_id = pr.dosen_id
             WHERE pr.revisi_id = ? ORDER BY pr.created_at DESC"
        );
        $stmt->execute([$revisiId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function respond($id, $status, $komentar = null)
    {
        $stmt = $this->db->prepare(
            "UPDATE PERSETUJUAN_REVISI SET status = ?, komentar = ?, tanggal_respons = NOW()
             WHERE persetujuan_revisi = ?"
        );
        return $stmt->execute([$status, $komentar, $id]);
    }
}
