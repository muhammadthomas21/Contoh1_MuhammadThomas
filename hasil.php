<?php
session_start();

// Cek apakah ada data pendaftaran
if (!isset($_SESSION['pendaftaran'])) {
    header('Location: index.php');
    exit;
}

$data = $_SESSION['pendaftaran'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kampus Kuaja - Hasil Pendaftaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="url-bar">http://kampuskuaja.ac.id</div>
            <nav class="nav-tabs">
                <div class="tab">Pilihan Beasiswa</div>
                <div class="tab">Daftar</div>
                <div class="tab active">Hasil</div>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <h1>HASIL PENDAFTARAN BEASISWA</h1>
            
            <div class="result-container">
                <div class="success-message">
                    <h2>✅ Pendaftaran Berhasil!</h2>
                    <p>Terima kasih telah mendaftar beasiswa. Berikut adalah detail pendaftaran Anda:</p>
                </div>

                <div class="result-details">
                    <table class="result-table">
                        <tr>
                            <td class="label">Nama Lengkap</td>
                            <td class="value">: <?php echo htmlspecialchars($data['nama']); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Email</td>
                            <td class="value">: <?php echo htmlspecialchars($data['email']); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Nomor HP</td>
                            <td class="value">: <?php echo htmlspecialchars($data['hp']); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Semester</td>
                            <td class="value">: Semester <?php echo htmlspecialchars($data['semester']); ?></td>
                        </tr>
                        <tr>
                            <td class="label">IPK</td>
                            <td class="value">: <?php echo htmlspecialchars($data['ipk']); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Pilihan Beasiswa</td>
                            <td class="value">: <?php echo htmlspecialchars($data['pilihan_beasiswa']); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Berkas Syarat</td>
                            <td class="value">: <?php echo htmlspecialchars($data['berkas']); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Status Ajuan</td>
                            <td class="value status-pending">: <?php echo htmlspecialchars($data['status_ajuan']); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Tanggal Pendaftaran</td>
                            <td class="value">: <?php echo date('d F Y H:i:s', strtotime($data['tanggal_daftar'])); ?></td>
                        </tr>
                    </table>
                </div>

                <div class="status-info">
                    <div class="alert info">
                        <strong>Informasi:</strong><br>
                        Status ajuan Anda saat ini adalah "<?php echo $data['status_ajuan']; ?>". 
                        Tim administrasi akan memverifikasi berkas Anda dalam 3-5 hari kerja. 
                        Anda akan dihubungi melalui email yang terdaftar untuk informasi lebih lanjut.
                    </div>
                </div>

                <div class="action-buttons">
                    <button onclick="window.print()" class="btn-print">🖨️ Cetak Bukti</button>
                    <a href="index.php" class="btn-back">← Kembali ke Form</a>
                    <button onclick="clearSession()" class="btn-clear">🗑️ Hapus Data</button>
                </div>
            </div>
        </main>
    </div>

    <script>
        function clearSession() {
            if (confirm('Apakah Anda yakin ingin menghapus data pendaftaran?')) {
                window.location.href = 'clear_session.php';
            }
        }
    </script>
</body>
</html>