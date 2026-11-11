<?php

require_once __DIR__ . '/BaseModel.php';

class RubrikPenilaianModel extends BaseModel
{
    protected $table = 'RUBRIK_PENILAIAN';
    protected $primaryKey = 'rubrik_penilaian_id';
    protected $fillable = ['program', 'kode', 'kategori_nama', 'nama_rubrik', 'nilai_min', 'nilai_max', 'urutan', 'aktif'];


    public function getByProgram($program, $activeOnly = true)
    {
        $sql = "SELECT * FROM RUBRIK_PENILAIAN WHERE program = ?";
        if ($activeOnly) {
            $sql .= " AND aktif = 1";
        }
        $sql .= " ORDER BY urutan ASC, rubrik_penilaian_id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([strtoupper($program)]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
