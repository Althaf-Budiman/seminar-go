<?php

require_once __DIR__ . '/BaseModel.php';

class PengajuanTopikDospemModel extends BaseModel
{
    protected $table = 'PENGAJUAN_TOPIK_DOSPEM';
    protected $primaryKey = 'pengajuan_bimbingan_id';
    protected $fillable = ['biaya', 'status_pengajuan', 'studi_kasus', 'sumber_referensi', 'abstrak', 'judul_skripsi', 'jenis_topik', 'topik', 'mahasiswa_id', 'topik_id', 'dosen_id', 'timeline_id'];


    public function getByMahasiswa($mahasiswaId, $status = null)
    {
        $sql = "SELECT p.*, t.deskripsi AS deskripsi_topik, d.nama_lengkap AS nama_dosen
                FROM PENGAJUAN_TOPIK_DOSPEM p
                LEFT JOIN TOPIK t ON t.topik_id = p.topik_id
                LEFT JOIN DOSEN d ON d.dosen_id = p.dosen_id
                WHERE p.mahasiswa_id = ?";
        $params = [$mahasiswaId];
        if ($status !== null) {
            $sql .= " AND p.status_pengajuan = ?";
            $params[] = $status;
        }
        $sql .= " ORDER BY p.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByDosen($dosenId)
    {
        $stmt = $this->db->prepare(
            "SELECT p.*, m.nama_lengkap AS nama_mahasiswa
             FROM PENGAJUAN_TOPIK_DOSPEM p
             JOIN MAHASISWA m ON m.mahasiswa_id = p.mahasiswa_id
             WHERE p.dosen_id = ? ORDER BY p.created_at DESC"
        );
        $stmt->execute([$dosenId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE PENGAJUAN_TOPIK_DOSPEM SET status_pengajuan = ? WHERE pengajuan_bimbingan_id = ?");
        return $stmt->execute([$status, $id]);
    }
}
