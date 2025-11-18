<?php
require_once 'models/Database.php';

class Perizinan {
    private $db;
    private $table = 'perizinan';

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT p.*, s.nis, u.nama_lengkap as siswa_nama, k.nama_kelas,
                   w.nama_lengkap as wali_kelas_nama
            FROM {$this->table} p
            JOIN siswa s ON p.siswa_id = s.id
            JOIN users u ON s.user_id = u.id
            JOIN kelas k ON s.kelas_id = k.id
            JOIN users w ON p.wali_kelas_id = w.id
            ORDER BY p.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT p.*, s.nis, u.nama_lengkap as siswa_nama, k.nama_kelas,
                   w.nama_lengkap as wali_kelas_nama
            FROM {$this->table} p
            JOIN siswa s ON p.siswa_id = s.id
            JOIN users u ON s.user_id = u.id
            JOIN kelas k ON s.kelas_id = k.id
            JOIN users w ON p.wali_kelas_id = w.id
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getBySiswaId($siswa_id) {
        $stmt = $this->db->prepare("
            SELECT p.*, s.nis, u.nama_lengkap as siswa_nama, k.nama_kelas,
                   w.nama_lengkap as wali_kelas_nama
            FROM {$this->table} p
            JOIN siswa s ON p.siswa_id = s.id
            JOIN users u ON s.user_id = u.id
            JOIN kelas k ON s.kelas_id = k.id
            JOIN users w ON p.wali_kelas_id = w.id
            WHERE p.siswa_id = ?
            ORDER BY p.created_at DESC
        ");
        $stmt->execute([$siswa_id]);
        return $stmt->fetchAll();
    }

    public function getByWaliKelasId($wali_kelas_id) {
        $stmt = $this->db->prepare("
            SELECT p.*, s.nis, u.nama_lengkap as siswa_nama, k.nama_kelas,
                   w.nama_lengkap as wali_kelas_nama
            FROM {$this->table} p
            JOIN siswa s ON p.siswa_id = s.id
            JOIN users u ON s.user_id = u.id
            JOIN kelas k ON s.kelas_id = k.id
            JOIN users w ON p.wali_kelas_id = w.id
            WHERE p.wali_kelas_id = ?
            ORDER BY p.created_at DESC
        ");
        $stmt->execute([$wali_kelas_id]);
        return $stmt->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (siswa_id, wali_kelas_id, tanggal_izin, jam_keluar, alasan) 
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['siswa_id'],
            $data['wali_kelas_id'],
            $data['tanggal_izin'],
            $data['jam_keluar'],
            $data['alasan']
        ]);
    }

    public function updateStatus($id, $status, $keterangan = null) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET status = ?, keterangan_wali_kelas = ?, updated_at = CURRENT_TIMESTAMP 
            WHERE id = ?
        ");
        return $stmt->execute([$status, $keterangan, $id]);
    }

    public function updateJamKembali($id, $jam_kembali) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET jam_kembali = ?, updated_at = CURRENT_TIMESTAMP 
            WHERE id = ?
        ");
        return $stmt->execute([$jam_kembali, $id]);
    }
}
?>