<?php

require_once __DIR__ . '/BaseModel.php';

class PenilaianModel extends BaseModel
{
    protected $table = 'PENILAIAN';
    protected $primaryKey = 'penilaian_id';
    protected $fillable = ['tanggal_pelaksanaan', 'jam_mulai', 'jam_selesai', 'tempat', 'status', 'mode_pelaksanaan', 'catatan_umum', 'keputusan_sidang', 'total_nilai', 'program', 'timeline_id', 'pendaftaran_sempro_id', 'pendaftaran_sidang_id'];


    public function getByTimeline($timelineId)
    {
        $stmt = $this->db->prepare("SELECT * FROM PENILAIAN WHERE timeline_id = ? ORDER BY created_at DESC");
        $stmt->execute([$timelineId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByPendaftaranSempro($pendaftaranId)
    {
        $stmt = $this->db->prepare("SELECT * FROM PENILAIAN WHERE pendaftaran_sempro_id = ? LIMIT 1");
        $stmt->execute([$pendaftaranId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getByPendaftaranSidang($pendaftaranId)
    {
        $stmt = $this->db->prepare("SELECT * FROM PENILAIAN WHERE pendaftaran_sidang_id = ? LIMIT 1");
        $stmt->execute([$pendaftaranId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getWithAssessors($penilaianId)
    {
        $stmt = $this->db->prepare(
            "SELECT p.*, dp.dosen_id, dp.role AS peran_dosen, dp.komentar AS komentar_dosen,
                    dp.total_nilai AS nilai_dosen, d.nama_lengkap AS nama_dosen
             FROM PENILAIAN p
             LEFT JOIN DOSEN_PENILAIAN dp ON dp.penilaian_id = p.penilaian_id
             LEFT JOIN DOSEN d ON d.dosen_id = dp.dosen_id
             WHERE p.penilaian_id = ?"
        );
        $stmt->execute([$penilaianId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE PENILAIAN SET status = ? WHERE penilaian_id = ?");
        return $stmt->execute([$status, $id]);
    }
}
