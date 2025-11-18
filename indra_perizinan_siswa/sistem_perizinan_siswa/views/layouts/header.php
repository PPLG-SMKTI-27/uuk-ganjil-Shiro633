<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perizinan Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f4f4; }
        .header { background: #2c3e50; color: white; padding: 1rem; }
        .nav { background: #34495e; padding: 0.5rem; }
        .nav a { color: white; text-decoration: none; margin-right: 1rem; padding: 0.5rem 1rem; }
        .nav a:hover { background: #1abc9c; }
        .container { max-width: 1200px; margin: 2rem auto; padding: 0 1rem; }
        .card { background: white; padding: 1rem; margin-bottom: 1rem; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .btn { padding: 0.5rem 1rem; border: none; border-radius: 3px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background: #3498db; color: white; }
        .btn-success { background: #27ae60; color: white; }
        .btn-warning { background: #f39c12; color: white; }
        .btn-danger { background: #e74c3c; color: white; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; }
        input, select, textarea { width: 100%; padding: 0.5rem; border: 1px solid #ddd; border-radius: 3px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sistem Perizinan Siswa</h1>
        <p>Selamat datang, <?php echo $_SESSION['nama_lengkap']; ?> (<?php echo $_SESSION['role']; ?>)</p>
    </div>
    
    <div class="nav">
        <a href="index.php?action=dashboard">Dashboard</a>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="index.php?action=users">Manajemen User</a>
            <a href="index.php?action=kelas">Manajemen Kelas</a>
            <a href="index.php?action=siswa">Manajemen Siswa</a>
        <?php endif; ?>
        <a href="index.php?action=perizinan">Perizinan</a>
        <?php if ($_SESSION['role'] === 'siswa'): ?>
            <a href="index.php?action=perizinan_create">Ajukan Perizinan</a>
        <?php endif; ?>
        <a href="index.php?action=logout" style="float: right;">Logout</a>
    </div>
    
    <div class="container">