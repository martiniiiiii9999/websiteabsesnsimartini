-- ==================================================
--   SCHEMA DATABASE SISTEM ABSENSI
-- ==================================================
-- File ini adalah dokumentasi SQL dari migration Laravel
-- Untuk membuat database, gunakan: php artisan migrate
-- ==================================================

-- Table: absensis
CREATE TABLE IF NOT EXISTS "absensis" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "nama" VARCHAR(100) NOT NULL,
    "nip" VARCHAR(50) NULL,
    "tanggal" DATE NOT NULL,
    "waktu_masuk" TIME NULL,
    "waktu_keluar" TIME NULL,
    "status" VARCHAR(255) NOT NULL DEFAULT 'hadir' CHECK("status" IN ('hadir', 'izin', 'sakit', 'alfa')),
    "keterangan" TEXT NULL,
    "created_at" TIMESTAMP NULL,
    "updated_at" TIMESTAMP NULL
);

-- Index untuk pencarian lebih cepat (opsional)
-- CREATE INDEX idx_absensi_tanggal ON absensis(tanggal);
-- CREATE INDEX idx_absensi_nama ON absensis(nama);
-- CREATE INDEX idx_absensi_status ON absensis(status);

-- Catatan:
-- - Tabel ini dibuat otomatis oleh migration Laravel
-- - Untuk reset database: php artisan migrate:fresh
-- - Untuk melihat struktur: php artisan migrate:status

