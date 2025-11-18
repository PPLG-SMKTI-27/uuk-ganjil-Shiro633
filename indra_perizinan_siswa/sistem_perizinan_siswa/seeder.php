<?php
require_once 'models/Database.php';
require_once 'models/User.php';
require_once 'models/Kelas.php';
require_once 'models/Siswa.php';

// Create admin user
$userModel = new User();
$userModel->create([
    'username' => 'admin',
    'password' => 'admin123',
    'role' => 'admin',
    'nama_lengkap' => 'Administrator',
    'email' => 'admin@sekolah.sch.id'
]);

// Create wali kelas
$userModel->create([
    'username' => 'wali_x',
    'password' => 'wali123',
    'role' => 'wali kelas',
    'nama_lengkap' => 'Budi Santoso, S.Pd',
    'email' => 'budi@sekolah.sch.id'
]);

// Create siswa user
$userModel->create([
    'username' => 'siswa1',
    'password' => 'siswa123',
    'role' => 'siswa',
    'nama_lengkap' => 'Andi Pratama',
    'email' => 'andi@sekolah.sch.id'
]);

// Create kelas
$kelasModel = new Kelas();
$kelasModel->create([
    'nama_kelas' => 'X IPA 1',
    'tingkat' => 'X',
    'wali_kelas_id' => 2  // ID wali kelas
]);

// Create siswa data
$siswaModel = new Siswa();
$siswaModel->create([
    'user_id' => 3,  // ID user siswa
    'kelas_id' => 1, // ID kelas
    'nis' => '2024001',
    'alamat' => 'Jl. Merdeka No. 123',
    'no_telepon' => '081234567890'
]);

echo "Data seeder berhasil ditambahkan!";
?>