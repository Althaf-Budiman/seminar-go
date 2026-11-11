<?php

require_once __DIR__ . '/BaseModel.php';

class TopikModel extends BaseModel
{
    protected $table = 'TOPIK';
    protected $primaryKey = 'topik_id';
    protected $fillable = ['deskripsi'];


    public function search($keyword)
    {
        $stmt = $this->db->prepare("SELECT * FROM TOPIK WHERE deskripsi LIKE ? ORDER BY deskripsi");
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
