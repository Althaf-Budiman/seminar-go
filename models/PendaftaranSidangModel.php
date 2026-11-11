<?php

require_once __DIR__ . '/BaseModel.php';

class PendaftaranSidangModel extends BaseModel
{
    protected $table = 'PENDAFTARAN_SIDANG';
    protected $primaryKey = 'pendaftaran_sidang_id';
    protected $fillable = ['persetujuan_pembimbing', 'status_pendaftaran', 'laporan_skripsi_url', 'form_f4', 'mahasiswa_id', 'timeline_id'];


    public function getByMahasiswa($mahasiswaId)
    {
        $stmt = $this->db->prepare("SELECT * FROM PENDAFTARAN_SIDANG WHERE mahasiswa_id = ? ORDER BY created_at DESC");
        $stmt->execute([$mahasiswaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByTimeline($timelineId)
    {
        $stmt = $this->db->prepare("SELECT * FROM PENDAFTARAN_SIDANG WHERE timeline_id = ? LIMIT 1");
        $stmt->execute([$timelineId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE PENDAFTARAN_SIDANG SET status_pendaftaran = ? WHERE pendaftaran_sidang_id = ?");
        return $stmt->execute([$status, $id]);
    }
}
