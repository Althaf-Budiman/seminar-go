<?php

require_once __DIR__ . '/BaseModel.php';

class YearModel extends BaseModel
{
    protected $table = 'YEAR';
    protected $primaryKey = 'year_id';
    protected $fillable = ['tahun'];


    public function getAllYears()
    {
        return $this->db->query("SELECT * FROM `YEAR` ORDER BY tahun DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByYear($year)
    {
        $stmt = $this->db->prepare("SELECT * FROM `YEAR` WHERE tahun = ? LIMIT 1");
        $stmt->execute([$year]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
