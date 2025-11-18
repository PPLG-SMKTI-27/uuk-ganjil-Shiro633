<?php
require_once 'models/Database.php';

class Kelas {
    private $db;
    private $table = 'kelas';

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT k.*, u.nama_lengkap as wali_kelas_nama 
            FROM {$this->table} k 
            LEFT JOIN users u ON k.wali_kelas_id = u.id
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (nama_kelas, tingkat, wali_kelas_id) VALUES (?, ?, ?)");
        return $stmt->execute([
            $data['nama_kelas'],
            $data['tingkat'],
            $data['wali_kelas_id']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET nama_kelas = ?, tingkat = ?, wali_kelas_id = ? WHERE id = ?");
        return $stmt->execute([
            $data['nama_kelas'],
            $data['tingkat'],
            $data['wali_kelas_id'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>