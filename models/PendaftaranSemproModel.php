<?php

require_once __DIR__ . '/BaseModel.php';

class PendaftaranSemproModel extends BaseModel
{
    protected $table = 'PENDAFTARAN_SEMPRO';
    protected $primaryKey = 'pendaftaran_sempro_id';
    protected $fillable = ['metode_penyelesaian', 'status_pendaftaran', 'naskah_proposal_url', 'form_f1_url', 'mahasiswa_id', 'timeline_id'];


    public function getByMahasiswa($mahasiswaId)
    {
        $stmt = $this->db->prepare("SELECT * FROM PENDAFTARAN_SEMPRO WHERE mahasiswa_id = ? ORDER BY created_at DESC");
        $stmt->execute([$mahasiswaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByTimeline($timelineId)
    {
        $stmt = $this->db->prepare("SELECT * FROM PENDAFTARAN_SEMPRO WHERE timeline_id = ? LIMIT 1");
        $stmt->execute([$timelineId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE PENDAFTARAN_SEMPRO SET status_pendaftaran = ? WHERE pendaftaran_sempro_id = ?");
        return $stmt->execute([$status, $id]);
    }
}
