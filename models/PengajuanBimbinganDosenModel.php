<?php

require_once __DIR__ . '/BaseModel.php';

class PengajuanBimbinganDosenModel extends BaseModel
{
    protected $table = 'PENGAJUAN_BIMBINGAN_DOSEN';
    protected $primaryKey = 'pengajuan_bimbingan_dosen_id';
    protected $fillable = ['prioritas', 'pengajuan_bimbingan_id', 'dosen_id'];


    public function getByPengajuan($pengajuanId)
    {
        $stmt = $this->db->prepare(
            "SELECT pbd.*, d.nama_lengkap, d.email, d.dosen_type
             FROM PENGAJUAN_BIMBINGAN_DOSEN pbd
             JOIN DOSEN d ON d.dosen_id = pbd.dosen_id
             WHERE pbd.pengajuan_bimbingan_id = ? ORDER BY pbd.prioritas ASC"
        );
        $stmt->execute([$pengajuanId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function replaceForPengajuan($pengajuanId, $dosenPrioritas)
    {
        $this->db->beginTransaction();
        try {
            $delete = $this->db->prepare("DELETE FROM PENGAJUAN_BIMBINGAN_DOSEN WHERE pengajuan_bimbingan_id = ?");
            $delete->execute([$pengajuanId]);
            $insert = $this->db->prepare(
                "INSERT INTO PENGAJUAN_BIMBINGAN_DOSEN (pengajuan_bimbingan_id, dosen_id, prioritas) VALUES (?, ?, ?)"
            );
            foreach ($dosenPrioritas as $prioritas => $dosenId) {
                $insert->execute([$pengajuanId, $dosenId, $prioritas + 1]);
            }
            $this->db->commit();
            return true;
        } catch (Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}
