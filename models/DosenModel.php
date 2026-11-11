<?php

require_once __DIR__ . '/BaseModel.php';

class DosenModel extends BaseModel
{
    protected $table = 'DOSEN';
    protected $primaryKey = 'dosen_id';
    protected $fillable = ['email', 'no_hp', 'dosen_type', 'nama_lengkap', 'quota_left', 'tanda_tangan', 'status', 'user_id'];


    public function getByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM DOSEN WHERE user_id = ? LIMIT 1");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getActive()
    {
        $stmt = $this->db->prepare("SELECT * FROM DOSEN WHERE status = ? ORDER BY nama_lengkap");
        $stmt->execute(['aktif']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateQuota($dosenId, $quotaLeft)
    {
        $stmt = $this->db->prepare("UPDATE DOSEN SET quota_left = ? WHERE dosen_id = ?");
        return $stmt->execute([(int) $quotaLeft, $dosenId]);
    }
}
