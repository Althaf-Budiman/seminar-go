<?php

require_once __DIR__ . '/BaseModel.php';

class AdminModel extends BaseModel
{
    protected $table = 'ADMIN';
    protected $primaryKey = 'admin_id';
    protected $fillable = ['nama_lengkap', 'no_hp', 'user_id'];


    public function getByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM ADMIN WHERE user_id = ? LIMIT 1");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
