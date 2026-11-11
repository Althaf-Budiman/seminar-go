<?php

require_once __DIR__ . '/BaseModel.php';

class KelompokModel extends BaseModel
{
    protected $table = 'KELOMPOK';
    protected $primaryKey = 'kelompok_id';
    protected $fillable = ['nama_kelompok'];


    public function getByName($name)
    {
        $stmt = $this->db->prepare("SELECT * FROM KELOMPOK WHERE nama_kelompok = ? LIMIT 1");
        $stmt->execute([$name]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
