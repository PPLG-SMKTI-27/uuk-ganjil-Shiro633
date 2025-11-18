<?php
require_once 'models/Database.php';

class Siswa {
    private $db;
    private $table = 'siswa';

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT s.*, u.nama_lengkap, u.username, k.nama_kelas 
            FROM {$this->table} s 
            JOIN users u ON s.user_id = u.id 
            JOIN kelas k ON s.kelas_id = k.id
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT s.*, u.nama_lengkap, u.username, k.nama_kelas 
            FROM {$this->table} s 
            JOIN users u ON s.user_id = u.id 
            JOIN kelas k ON s.kelas_id = k.id 
            WHERE s.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getByUserId($user_id) {
        $stmt = $this->db->prepare("
            SELECT s.*, u.nama_lengkap, u.username, k.nama_kelas 
            FROM {$this->table} s 
            JOIN users u ON s.user_id = u.id 
            JOIN kelas k ON s.kelas_id = k.id 
            WHERE s.user_id = ?
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (user_id, kelas_id, nis, alamat, no_telepon) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['user_id'],
            $data['kelas_id'],
            $data['nis'],
            $data['alamat'],
            $data['no_telepon']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET kelas_id = ?, nis = ?, alamat = ?, no_telepon = ? WHERE id = ?");
        return $stmt->execute([
            $data['kelas_id'],
            $data['nis'],
            $data['alamat'],
            $data['no_telepon'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>