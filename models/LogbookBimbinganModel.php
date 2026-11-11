<?php

require_once __DIR__ . '/BaseModel.php';

class LogbookBimbinganModel extends BaseModel
{
    protected $table = 'LOGBOOK_BIMBINGAN';
    protected $primaryKey = 'logbook_id';
    protected $fillable = ['manfaat', 'tujuan', 'tanggal', 'tempat', 'uraian', 'rencana_pencapaian', 'status', 'program', 'mahasiswa_id', 'dosen_id', 'timeline_id'];


    public function getByMahasiswa($mahasiswaId, $program = null)
    {
        $sql = "SELECT l.*, d.nama_lengkap AS nama_dosen
                FROM LOGBOOK_BIMBINGAN l
                LEFT JOIN DOSEN d ON d.dosen_id = l.dosen_id
                WHERE l.mahasiswa_id = ?";
        $params = [$mahasiswaId];
        if ($program !== null) {
            $sql .= " AND l.program = ?";
            $params[] = strtoupper($program);
        }
        $sql .= " ORDER BY l.tanggal DESC, l.logbook_id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByDosen($dosenId, $status = null)
    {
        $sql = "SELECT l.*, m.nama_lengkap AS nama_mahasiswa
                FROM LOGBOOK_BIMBINGAN l
                JOIN MAHASISWA m ON m.mahasiswa_id = l.mahasiswa_id
                WHERE l.dosen_id = ?";
        $params = [$dosenId];
        if ($status !== null) {
            $sql .= " AND l.status = ?";
            $params[] = $status;
        }
        $sql .= " ORDER BY l.tanggal DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countByStatus($mahasiswaId, $program, $status)
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM LOGBOOK_BIMBINGAN WHERE mahasiswa_id = ? AND program = ? AND status = ?"
        );
        $stmt->execute([$mahasiswaId, strtoupper($program), $status]);
        return (int) $stmt->fetchColumn();
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE LOGBOOK_BIMBINGAN SET status = ? WHERE logbook_id = ?");
        return $stmt->execute([$status, $id]);
    }
}
