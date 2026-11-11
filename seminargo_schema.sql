-- SeminarGo - MySQL schema
-- Only for reference

SET NAMES utf8mb4;

CREATE TABLE `USER` (
    user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    identification_number VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id),
    UNIQUE KEY uq_user_identification_number (identification_number)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE KELOMPOK (
    kelompok_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nama_kelompok VARCHAR(50) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (kelompok_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE DOSEN (
    dosen_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    dosen_type VARCHAR(30) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    quota_left SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    tanda_tangan VARCHAR(500) NULL,
    status VARCHAR(20) NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (dosen_id),
    UNIQUE KEY uq_dosen_email (email),
    UNIQUE KEY uq_dosen_no_hp (no_hp),
    UNIQUE KEY uq_dosen_user (user_id),
    CONSTRAINT fk_dosen_user FOREIGN KEY (user_id) REFERENCES `USER` (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE MAHASISWA (
    mahasiswa_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    no_hp_orangtua VARCHAR(20) NOT NULL,
    nama_orangtua VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    program_studi VARCHAR(100) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    kelas VARCHAR(30) NOT NULL,
    alamat TEXT NOT NULL,
    foto VARCHAR(500) NULL,
    tahun_akademik VARCHAR(15) NOT NULL,
    mahasiswa_aktif BOOLEAN NOT NULL DEFAULT TRUE,
    user_id INT UNSIGNED NOT NULL,
    kelompok_id INT UNSIGNED NOT NULL,
    dosen_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (mahasiswa_id),
    UNIQUE KEY uq_mahasiswa_email (email),
    UNIQUE KEY uq_mahasiswa_no_hp (no_hp),
    UNIQUE KEY uq_mahasiswa_user (user_id),
    CONSTRAINT fk_mahasiswa_user FOREIGN KEY (user_id) REFERENCES `USER` (user_id),
    CONSTRAINT fk_mahasiswa_kelompok FOREIGN KEY (kelompok_id) REFERENCES KELOMPOK (kelompok_id),
    CONSTRAINT fk_mahasiswa_dosen FOREIGN KEY (dosen_id) REFERENCES DOSEN (dosen_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ADMIN (
    admin_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nama_lengkap VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (admin_id),
    UNIQUE KEY uq_admin_no_hp (no_hp),
    UNIQUE KEY uq_admin_user (user_id),
    CONSTRAINT fk_admin_user FOREIGN KEY (user_id) REFERENCES `USER` (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE TIMELINE (
    timeline_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    status VARCHAR(25) NOT NULL,
    judul VARCHAR(150) NOT NULL,
    deskripsi TEXT NULL,
    tanggal DATE NOT NULL,
    waktu TIME NULL,
    program ENUM('SEMPRO', 'SKRIPSI') NOT NULL,
    tahun_akademik VARCHAR(15) NOT NULL,
    mahasiswa_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (timeline_id),
    KEY idx_timeline_mahasiswa_program_tahun (mahasiswa_id, program, tahun_akademik),
    CONSTRAINT fk_timeline_mahasiswa FOREIGN KEY (mahasiswa_id) REFERENCES MAHASISWA (mahasiswa_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE PENDAFTARAN_SIDANG (
    pendaftaran_sidang_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    persetujuan_pembimbing BOOLEAN NOT NULL DEFAULT FALSE,
    status_pendaftaran VARCHAR(25) NOT NULL,
    laporan_skripsi_url VARCHAR(1000) NULL,
    form_f4 VARCHAR(1000) NULL,
    mahasiswa_id INT UNSIGNED NOT NULL,
    timeline_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (pendaftaran_sidang_id),
    CONSTRAINT fk_pendaftaran_sidang_mahasiswa FOREIGN KEY (mahasiswa_id) REFERENCES MAHASISWA (mahasiswa_id),
    CONSTRAINT fk_pendaftaran_sidang_timeline FOREIGN KEY (timeline_id) REFERENCES TIMELINE (timeline_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE LOGBOOK_BIMBINGAN (
    logbook_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    manfaat TEXT NOT NULL,
    tujuan TEXT NOT NULL,
    tanggal DATE NOT NULL,
    tempat VARCHAR(150) NOT NULL,
    uraian TEXT NOT NULL,
    rencana_pencapaian TEXT NOT NULL,
    status VARCHAR(25) NOT NULL,
    program ENUM('SEMPRO', 'SKRIPSI') NOT NULL,
    mahasiswa_id INT UNSIGNED NOT NULL,
    dosen_id INT UNSIGNED NOT NULL,
    timeline_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (logbook_id),
    CONSTRAINT fk_logbook_mahasiswa FOREIGN KEY (mahasiswa_id) REFERENCES MAHASISWA (mahasiswa_id),
    CONSTRAINT fk_logbook_dosen FOREIGN KEY (dosen_id) REFERENCES DOSEN (dosen_id),
    CONSTRAINT fk_logbook_timeline FOREIGN KEY (timeline_id) REFERENCES TIMELINE (timeline_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE PENDAFTARAN_SEMPRO (
    pendaftaran_sempro_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    metode_penyelesaian VARCHAR(100) NOT NULL,
    status_pendaftaran VARCHAR(25) NOT NULL,
    naskah_proposal_url VARCHAR(1000) NULL,
    form_f1_url VARCHAR(1000) NULL,
    mahasiswa_id INT UNSIGNED NOT NULL,
    timeline_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (pendaftaran_sempro_id),
    CONSTRAINT fk_pendaftaran_sempro_mahasiswa FOREIGN KEY (mahasiswa_id) REFERENCES MAHASISWA (mahasiswa_id),
    CONSTRAINT fk_pendaftaran_sempro_timeline FOREIGN KEY (timeline_id) REFERENCES TIMELINE (timeline_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE TOPIK (
    topik_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    deskripsi VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (topik_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE PENGAJUAN_TOPIK_DOSPEM (
    pengajuan_bimbingan_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    biaya DECIMAL(15,2) NOT NULL,
    status_pengajuan VARCHAR(25) NOT NULL,
    studi_kasus TEXT NOT NULL,
    sumber_referensi TEXT NOT NULL,
    abstrak TEXT NOT NULL,
    judul_skripsi VARCHAR(255) NOT NULL,
    jenis_topik VARCHAR(30) NOT NULL,
    topik VARCHAR(100) NOT NULL,
    mahasiswa_id INT UNSIGNED NOT NULL,
    topik_id INT UNSIGNED NOT NULL,
    dosen_id INT UNSIGNED NOT NULL,
    timeline_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (pengajuan_bimbingan_id),
    CONSTRAINT fk_pengajuan_topik_mahasiswa FOREIGN KEY (mahasiswa_id) REFERENCES MAHASISWA (mahasiswa_id),
    CONSTRAINT fk_pengajuan_topik_topik FOREIGN KEY (topik_id) REFERENCES TOPIK (topik_id),
    CONSTRAINT fk_pengajuan_topik_dosen FOREIGN KEY (dosen_id) REFERENCES DOSEN (dosen_id),
    CONSTRAINT fk_pengajuan_topik_timeline FOREIGN KEY (timeline_id) REFERENCES TIMELINE (timeline_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE PENGAJUAN_BIMBINGAN_DOSEN (
    pengajuan_bimbingan_dosen_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    prioritas TINYINT UNSIGNED NOT NULL,
    pengajuan_bimbingan_id INT UNSIGNED NOT NULL,
    dosen_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (pengajuan_bimbingan_dosen_id),
    UNIQUE KEY uq_pengajuan_bimbingan_dosen (pengajuan_bimbingan_id, dosen_id),
    CONSTRAINT fk_pengajuan_bimbingan_dosen_pengajuan FOREIGN KEY (pengajuan_bimbingan_id) REFERENCES PENGAJUAN_TOPIK_DOSPEM (pengajuan_bimbingan_id),
    CONSTRAINT fk_pengajuan_bimbingan_dosen_dosen FOREIGN KEY (dosen_id) REFERENCES DOSEN (dosen_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE PENILAIAN (
    penilaian_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    tanggal_pelaksanaan DATE NULL,
    jam_mulai TIME NULL,
    jam_selesai TIME NULL,
    tempat VARCHAR(150) NULL,
    status VARCHAR(30) NOT NULL,
    mode_pelaksanaan VARCHAR(30) NULL,
    catatan_umum TEXT NULL,
    keputusan_sidang VARCHAR(100) NULL,
    total_nilai DECIMAL(5,2) NULL,
    program ENUM('SEMPRO', 'SKRIPSI') NOT NULL,
    timeline_id INT UNSIGNED NOT NULL,
    pendaftaran_sempro_id INT UNSIGNED NULL,
    pendaftaran_sidang_id INT UNSIGNED NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (penilaian_id),
    CONSTRAINT fk_penilaian_timeline FOREIGN KEY (timeline_id) REFERENCES TIMELINE (timeline_id),
    CONSTRAINT fk_penilaian_sempro FOREIGN KEY (pendaftaran_sempro_id) REFERENCES PENDAFTARAN_SEMPRO (pendaftaran_sempro_id),
    CONSTRAINT fk_penilaian_sidang FOREIGN KEY (pendaftaran_sidang_id) REFERENCES PENDAFTARAN_SIDANG (pendaftaran_sidang_id),
    CONSTRAINT chk_penilaian_pendaftaran_program CHECK (
        (program = 'SEMPRO' AND pendaftaran_sempro_id IS NOT NULL AND pendaftaran_sidang_id IS NULL)
        OR
        (program = 'SKRIPSI' AND pendaftaran_sidang_id IS NOT NULL AND pendaftaran_sempro_id IS NULL)
    )
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE REVISI (
    revisi_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    program ENUM('SEMPRO', 'SKRIPSI') NOT NULL,
    komentar TEXT NOT NULL,
    status VARCHAR(25) NOT NULL DEFAULT 'BELUM',
    file_url VARCHAR(1000) NULL,
    tanggal_selesai DATE NULL,
    penilaian_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (revisi_id),
    CONSTRAINT fk_revisi_penilaian FOREIGN KEY (penilaian_id) REFERENCES PENILAIAN (penilaian_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE NOTIFIKASI (
    notifikasi_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    judul VARCHAR(150) NOT NULL,
    isi TEXT NOT NULL,
    is_read BOOLEAN NOT NULL DEFAULT FALSE,
    dibaca_pada DATETIME NULL,
    user_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (notifikasi_id),
    KEY idx_notifikasi_user_created (user_id, created_at),
    CONSTRAINT fk_notifikasi_user FOREIGN KEY (user_id) REFERENCES `USER` (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `YEAR` (
    year_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    tahun SMALLINT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (year_id),
    UNIQUE KEY uq_year_tahun (tahun)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE BERKAS (
    berkas_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    jenis VARCHAR(50) NOT NULL,
    nama_file VARCHAR(255) NOT NULL,
    path VARCHAR(1000) NULL,
    url VARCHAR(1000) NULL,
    status VARCHAR(30) NULL,
    diverifikasi_pada DATETIME NULL,
    mahasiswa_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (berkas_id),
    CONSTRAINT fk_berkas_mahasiswa FOREIGN KEY (mahasiswa_id) REFERENCES MAHASISWA (mahasiswa_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE PENGAJUAN_MAJU_SIDANG (
    pengajuan_maju_sidang_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    program ENUM('SEMPRO', 'SKRIPSI') NOT NULL,
    status VARCHAR(25) NOT NULL,
    tanggal_pengajuan DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    mahasiswa_id INT UNSIGNED NOT NULL,
    dosen_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (pengajuan_maju_sidang_id),
    CONSTRAINT fk_pengajuan_maju_sidang_mahasiswa FOREIGN KEY (mahasiswa_id) REFERENCES MAHASISWA (mahasiswa_id),
    CONSTRAINT fk_pengajuan_maju_sidang_dosen FOREIGN KEY (dosen_id) REFERENCES DOSEN (dosen_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE PERSETUJUAN_REVISI (
    persetujuan_revisi INT UNSIGNED NOT NULL AUTO_INCREMENT,
    status VARCHAR(25) NOT NULL,
    komentar TEXT NULL,
    tanggal_diajukan DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    tanggal_respons DATETIME NULL,
    revisi_id INT UNSIGNED NOT NULL,
    dosen_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (persetujuan_revisi),
    CONSTRAINT fk_persetujuan_revisi_revisi FOREIGN KEY (revisi_id) REFERENCES REVISI (revisi_id),
    CONSTRAINT fk_persetujuan_revisi_dosen FOREIGN KEY (dosen_id) REFERENCES DOSEN (dosen_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE RUBRIK_PENILAIAN (
    rubrik_penilaian_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    program ENUM('SEMPRO', 'SKRIPSI') NOT NULL,
    kode VARCHAR(20) NOT NULL,
    kategori_nama VARCHAR(100) NOT NULL,
    nama_rubrik VARCHAR(150) NOT NULL,
    nilai_min DECIMAL(5,2) NOT NULL,
    nilai_max DECIMAL(5,2) NOT NULL,
    urutan SMALLINT UNSIGNED NOT NULL,
    aktif BOOLEAN NOT NULL DEFAULT TRUE,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (rubrik_penilaian_id),
    UNIQUE KEY uq_rubrik_program_kode (program, kode),
    CONSTRAINT chk_rubrik_nilai_range CHECK (nilai_min <= nilai_max)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE DOSEN_PENILAIAN (
    dosen_penilaian_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    komentar TEXT NULL,
    total_nilai DECIMAL(5,2) NULL,
    role VARCHAR(30) NOT NULL,
    dosen_id INT UNSIGNED NOT NULL,
    penilaian_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (dosen_penilaian_id),
    UNIQUE KEY uq_dosen_penilaian_pair (penilaian_id, dosen_id),
    CONSTRAINT fk_dosen_penilaian_dosen FOREIGN KEY (dosen_id) REFERENCES DOSEN (dosen_id),
    CONSTRAINT fk_dosen_penilaian_penilaian FOREIGN KEY (penilaian_id) REFERENCES PENILAIAN (penilaian_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE DETAIL_RUBRIK_NILAI (
    detail_rubrik_nilai_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nilai DECIMAL(5,2) NOT NULL,
    dosen_id INT UNSIGNED NOT NULL,
    rubrik_penilaian_id INT UNSIGNED NOT NULL,
    penilaian_id INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (detail_rubrik_nilai_id),
    UNIQUE KEY uq_detail_nilai_rubrik (penilaian_id, dosen_id, rubrik_penilaian_id),
    CONSTRAINT fk_detail_nilai_dosen_penilaian FOREIGN KEY (penilaian_id, dosen_id)
        REFERENCES DOSEN_PENILAIAN (penilaian_id, dosen_id),
    CONSTRAINT fk_detail_nilai_rubrik FOREIGN KEY (rubrik_penilaian_id)
        REFERENCES RUBRIK_PENILAIAN (rubrik_penilaian_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
