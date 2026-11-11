<?php

require_once __DIR__ . '/BaseModel.php';

class TimelineModel extends BaseModel
{
    protected $table = 'TIMELINE';
    protected $primaryKey = 'timeline_id';
    protected $fillable = ['status', 'judul', 'deskripsi', 'tanggal', 'waktu', 'program', 'tahun_akademik', 'mahasiswa_id'];


    public function getByMahasiswa($mahasiswaId, $program = null, $tahunAkademik = null)
    {
        $sql = "SELECT * FROM TIMELINE WHERE mahasiswa_id = ?";
        $params = [$mahasiswaId];
        if ($program !== null) {
            $sql .= " AND program = ?";
            $params[] = strtoupper($program);
        }
        if ($tahunAkademik !== null) {
            $sql .= " AND tahun_akademik = ?";
            $params[] = $tahunAkademik;
        }
        $sql .= " ORDER BY tanggal DESC, waktu DESC, timeline_id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLatestByMahasiswa($mahasiswaId, $program, $tahunAkademik)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM TIMELINE WHERE mahasiswa_id = ? AND program = ? AND tahun_akademik = ?
             ORDER BY tanggal DESC, timeline_id DESC LIMIT 1"
        );
        $stmt->execute([$mahasiswaId, strtoupper($program), $tahunAkademik]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
