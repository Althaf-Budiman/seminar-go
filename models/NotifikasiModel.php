<?php

require_once __DIR__ . '/BaseModel.php';

class NotifikasiModel extends BaseModel
{
    protected $table = 'NOTIFIKASI';
    protected $primaryKey = 'notifikasi_id';
    protected $fillable = ['judul', 'isi', 'is_read', 'dibaca_pada', 'user_id'];


    public function getByUser($userId, $limit = 20)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM NOTIFIKASI WHERE user_id = ? ORDER BY created_at DESC LIMIT ?"
        );
        $stmt->bindValue(1, $userId, PDO::PARAM_INT);
        $stmt->bindValue(2, max(1, (int) $limit), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countUnread($userId)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM NOTIFIKASI WHERE user_id = ? AND is_read = 0");
        $stmt->execute([$userId]);
        return (int) $stmt->fetchColumn();
    }

    public function markAsRead($id, $userId)
    {
        $stmt = $this->db->prepare(
            "UPDATE NOTIFIKASI SET is_read = 1, dibaca_pada = NOW() WHERE notifikasi_id = ? AND user_id = ?"
        );
        return $stmt->execute([$id, $userId]);
    }

    public function markAllAsRead($userId)
    {
        $stmt = $this->db->prepare(
            "UPDATE NOTIFIKASI SET is_read = 1, dibaca_pada = NOW() WHERE user_id = ? AND is_read = 0"
        );
        return $stmt->execute([$userId]);
    }
}
