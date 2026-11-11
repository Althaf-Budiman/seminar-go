<?php

require_once __DIR__ . '/BaseModel.php';

class PengajuanMajuSidangModel extends BaseModel
{
    protected $table = 'PENGAJUAN_MAJU_SIDANG';
    protected $primaryKey = 'pengajuan_maju_sidang_id';
    protected $fillable = ['program', 'status', 'tanggal_pengajuan', 'mahasiswa_id', 'dosen_id'];


    public function getByMahasiswa($mahasiswaId, $program = null)
    {
        $sql = "SELECT p.*, d.nama_lengkap AS nama_dosen
                FROM PENGAJUAN_MAJU_SIDANG p
                LEFT JOIN DOSEN d ON d.dosen_id = p.dosen_id
                WHERE p.mahasiswa_id = ?";
        $params = [$mahasiswaId];
        if ($program !== null) {
            $sql .= " AND p.program = ?";
            $params[] = strtoupper($program);
        }
        $sql .= " ORDER BY p.tanggal_pengajuan DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByDosen($dosenId, $status = null)
    {
        $sql = "SELECT p.*, m.nama_lengkap AS nama_mahasiswa
                FROM PENGAJUAN_MAJU_SIDANG p
                JOIN MAHASISWA m ON m.mahasiswa_id = p.mahasiswa_id
                WHERE p.dosen_id = ?";
        $params = [$dosenId];
        if ($status !== null) {
            $sql .= " AND p.status = ?";
            $params[] = $status;
        }
        $sql .= " ORDER BY p.tanggal_pengajuan DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
