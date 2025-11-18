<?php include 'views/layouts/header.php'; ?>

<h2>Dashboard Admin</h2>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
    <div class="card">
        <h3>Total Perizinan</h3>
        <p style="font-size: 2rem; color: #3498db;"><?php echo $totalPerizinan; ?></p>
    </div>
    <div class="card">
        <h3>Total Siswa</h3>
        <p style="font-size: 2rem; color: #27ae60;"><?php echo $totalSiswa; ?></p>
    </div>
    <div class="card">
        <h3>Total Kelas</h3>
        <p style="font-size: 2rem; color: #f39c12;"><?php echo $totalKelas; ?></p>
    </div>
    <div class="card">
        <h3>Total User</h3>
        <p style="font-size: 2rem; color: #9b59b6;"><?php echo $totalUsers; ?></p>
    </div>
</div>

<h3>Fitur Admin</h3>
<div class="card">
    <ul>
        <li><a href="index.php?action=users">Manajemen User</a> - Kelola data pengguna sistem</li>
        <li><a href="index.php?action=kelas">Manajemen Kelas</a> - Kelola data kelas dan wali kelas</li>
        <li><a href="index.php?action=siswa">Manajemen Siswa</a> - Kelola data siswa</li>
        <li><a href="index.php?action=perizinan">Monitoring Perizinan</a> - Lihat semua perizinan siswa</li>
    </ul>
</div>

<?php include 'views/layouts/footer.php'; ?>