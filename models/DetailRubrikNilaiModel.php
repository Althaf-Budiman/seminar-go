<?php

require_once __DIR__ . '/BaseModel.php';

class DetailRubrikNilaiModel extends BaseModel
{
    protected $table = 'DETAIL_RUBRIK_NILAI';
    protected $primaryKey = 'detail_rubrik_nilai_id';
    protected $fillable = ['nilai', 'dosen_id', 'rubrik_penilaian_id', 'penilaian_id'];


    public function getByPenilaianDosen($penilaianId, $dosenId)
    {
        $stmt = $this->db->prepare(
            "SELECT drn.*, rp.kode, rp.kategori_nama, rp.nama_rubrik, rp.nilai_min, rp.nilai_max
             FROM DETAIL_RUBRIK_NILAI drn
             JOIN RUBRIK_PENILAIAN rp ON rp.rubrik_penilaian_id = drn.rubrik_penilaian_id
             WHERE drn.penilaian_id = ? AND drn.dosen_id = ?
             ORDER BY rp.urutan ASC"
        );
        $stmt->execute([$penilaianId, $dosenId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveScore($penilaianId, $dosenId, $rubrikId, $nilai)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO DETAIL_RUBRIK_NILAI (penilaian_id, dosen_id, rubrik_penilaian_id, nilai)
             VALUES (?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE nilai = VALUES(nilai)"
        );
        return $stmt->execute([$penilaianId, $dosenId, $rubrikId, $nilai]);
    }
}
