<?php

require_once __DIR__ . '/BaseModel.php';

class YearModel extends BaseModel
{
    protected $table = 'YEAR';
    protected $primaryKey = 'year_id';
    protected $fillable = ['tahun_akademik'];

    public function getAllYears()
    {
        try {
            return $this->db->query("SELECT * FROM `YEAR` ORDER BY tahun_akademik DESC")->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $this->db->query("SELECT * FROM `YEAR` ORDER BY tahun DESC")->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getByYear($year)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `YEAR` WHERE tahun_akademik = ? LIMIT 1");
            $stmt->execute([$year]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            $stmt = $this->db->prepare("SELECT * FROM `YEAR` WHERE tahun = ? LIMIT 1");
            $stmt->execute([$year]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        }
    }
}
