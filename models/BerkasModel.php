<?php

require_once __DIR__ . '/BaseModel.php';

class BerkasModel extends BaseModel
{
    protected $table = 'BERKAS';
    protected $primaryKey = 'berkas_id';
    protected $fillable = ['jenis', 'nama_file', 'path', 'url', 'status', 'diverifikasi_pada', 'mahasiswa_id'];


    public function getByMahasiswa($mahasiswaId, $jenis = null)
    {
        $sql = "SELECT * FROM BERKAS WHERE mahasiswa_id = ?";
        $params = [$mahasiswaId];
        if ($jenis !== null) {
            $sql .= " AND jenis = ?";
            $params[] = $jenis;
        }
        $sql .= " ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare(
            "UPDATE BERKAS SET status = ?, diverifikasi_pada = NOW() WHERE berkas_id = ?"
        );
        return $stmt->execute([$status, $id]);
    }
}
