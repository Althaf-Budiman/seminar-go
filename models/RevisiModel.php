<?php

require_once __DIR__ . '/BaseModel.php';

class RevisiModel extends BaseModel
{
    protected $table = 'REVISI';
    protected $primaryKey = 'revisi_id';
    protected $fillable = ['komentar', 'program', 'status', 'file_url', 'tanggal_selesai', 'penilaian_id'];


    public function getByPenilaian($penilaianId)
    {
        $stmt = $this->db->prepare("SELECT * FROM REVISI WHERE penilaian_id = ? ORDER BY revisi_id ASC");
        $stmt->execute([$penilaianId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status, $tanggalSelesai = null)
    {
        $stmt = $this->db->prepare("UPDATE REVISI SET status = ?, tanggal_selesai = ? WHERE revisi_id = ?");
        return $stmt->execute([$status, $tanggalSelesai, $id]);
    }
}
