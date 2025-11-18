<?php include 'views/layouts/header.php'; ?>

<h2>Ajukan Perizinan</h2>

<?php if (isset($error)): ?>
    <div style="background: #f8d7da; color: #721c24; padding: 0.75rem; border-radius: 3px; margin-bottom: 1rem;">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

<div class="card">
    <form method="POST">
        <div class="form-group">
            <label>Tanggal Izin:</label>
            <input type="date" name="tanggal_izin" required value="<?php echo date('Y-m-d'); ?>">
        </div>
        
        <div class="form-group">
            <label>Jam Keluar:</label>
            <input type="time" name="jam_keluar" required>
        </div>
        
        <div class="form-group">
            <label>Alasan:</label>
            <textarea name="alasan" rows="4" required placeholder="Jelaskan alasan perizinan..."></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Ajukan Perizinan</button>
        <a href="index.php?action=perizinan" class="btn">Batal</a>
    </form>
</div>

<?php include 'views/layouts/footer.php'; ?>