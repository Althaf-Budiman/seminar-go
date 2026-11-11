# SeminarGo Models

KelompokModel, DosenModel, MahasiswaModel, AdminModel, TimelineModel,
PendaftaranSidangModel, LogbookBimbinganModel, PendaftaranSemproModel,
TopikModel, PengajuanTopikDospemModel, PengajuanBimbinganDosenModel,
PenilaianModel, RevisiModel, NotifikasiModel, YearModel, BerkasModel,
PengajuanMajuSidangModel, PersetujuanRevisiModel, RubrikPenilaianModel,
DosenPenilaianModel, DetailRubrikNilaiModel.

## Pola pemakaian

Setiap model memiliki metode umum:
- `getAll($limit = null, $offset = 0)`
- `getById($id)`
- `create($data)` -> mengembalikan ID baru
- `update($id, $data)`
- `delete($id)`
- `countAll()`

Model tertentu memiliki metode tambahan sesuai kebutuhan tabel, misalnya `getByMahasiswa()`,
`getByDosen()`, `getByProgram()`, `countUnread()`, `markAsRead()`, dan `saveScore()`.

Contoh:

```php
require_once __DIR__ . '/../../models/TimelineModel.php';

class Timeline
{
    private $model;

    public function __construct()
    {
        $this->model = new TimelineModel();
    }
}
```

## Catatan penting

1. `BaseModel` menggunakan PDO dan mengharapkan `$conn` tersedia dari `config/database.php`, sama seperti `UserModel`.
2. `fillable` membatasi kolom yang boleh di-insert/update. Kolom ID, `created_at`, dan `updated_at` dikelola database.
3. Nilai enum program dinormalisasi dengan `strtoupper()` pada beberapa metode filter.
4. Nilai status (`aktif`, `BELUM`, `disetujui`, dan sebagainya) harus disamakan dengan nilai yang dipakai controller dan database.
5. `getAll()` tidak otomatis melakukan JOIN; gunakan metode relasi yang tersedia atau tambahkan metode khusus sesuai halaman.
6. `PENGAJUAN_BIMBINGAN_DOSEN::replaceForPengajuan()` mengganti seluruh pilihan dosen untuk satu pengajuan dalam transaksi database.
