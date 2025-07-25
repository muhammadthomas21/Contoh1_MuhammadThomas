<?php
session_start();

// Konstanta IPK (simulasi data dari sistem)
define('IPK_MAHASISWA', 3.4); // Bisa diubah ke 2.9 untuk testing

// Proses form submission
if ($_POST) {
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $hp = $_POST['hp'] ?? '';
    $semester = $_POST['semester'] ?? '';
    $pilihan_beasiswa = $_POST['pilihan_beasiswa'] ?? '';
    $berkas = $_FILES['berkas'] ?? null;
    
    // Validasi email
    $email_valid = filter_var($email, FILTER_VALIDATE_EMAIL);
    
    // Validasi HP (hanya angka)
    $hp_valid = is_numeric($hp) && strlen($hp) >= 10;
    
    // Validasi semester (1-8)
    $semester_valid = in_array($semester, range(1, 8));
    
    // Upload berkas
    $berkas_uploaded = false;
    $berkas_name = '';
    if ($berkas && $berkas['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $berkas_name = time() . '_' . $berkas['name'];
        $berkas_uploaded = move_uploaded_file($berkas['tmp_name'], $upload_dir . $berkas_name);
    }
    
    if ($email_valid && $hp_valid && $semester_valid && IPK_MAHASISWA >= 3 && $berkas_uploaded) {
        // Simpan data ke session (simulasi database)
        $_SESSION['pendaftaran'] = [
            'nama' => $nama,
            'email' => $email,
            'hp' => $hp,
            'semester' => $semester,
            'ipk' => IPK_MAHASISWA,
            'pilihan_beasiswa' => $pilihan_beasiswa,
            'berkas' => $berkas_name,
            'status_ajuan' => 'belum di verifikasi',
            'tanggal_daftar' => date('Y-m-d H:i:s')
        ];
        
        header('Location: hasil.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kampus Kuaja - Daftar Beasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="url-bar">http://kampuskuaja.ac.id</div>
            <nav class="nav-tabs">
                <div class="tab">Pilihan Beasiswa</div>
                <div class="tab active">Daftar</div>
                <div class="tab">Hasil</div>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <h1>DAFTAR BEASISWA</h1>
            
            <div class="form-container">
                <h2>Registrasi Beasiswa</h2>
                
                <!-- IPK Display -->
                <div class="ipk-display">
                    <strong>IPK Anda: <?php echo IPK_MAHASISWA; ?></strong>
                    <?php if (IPK_MAHASISWA < 3): ?>
                        <div class="alert error">
                            Maaf, IPK Anda tidak memenuhi syarat untuk mendaftar beasiswa (minimal 3.0)
                        </div>
                    <?php else: ?>
                        <div class="alert success">
                            IPK Anda memenuhi syarat untuk mendaftar beasiswa
                        </div>
                    <?php endif; ?>
                </div>

                <form id="registrationForm" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Masukkan Nama</label>
                        <input type="text" id="nama" name="nama" required value="<?php echo $_POST['nama'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Masukkan Email</label>
                        <input type="email" id="email" name="email" required value="<?php echo $_POST['email'] ?? ''; ?>">
                        <div class="error-message" id="emailError"></div>
                    </div>

                    <div class="form-group">
                        <label for="hp">Nomor HP</label>
                        <input type="text" id="hp" name="hp" required pattern="[0-9]+" value="<?php echo $_POST['hp'] ?? ''; ?>">
                        <div class="error-message" id="hpError"></div>
                    </div>

                    <div class="form-group">
                        <label for="semester">Semester saat ini</label>
                        <select id="semester" name="semester" required>
                            <option value="">Pilih</option>
                            <?php for ($i = 1; $i <= 8; $i++): ?>
                                <option value="<?php echo $i; ?>" <?php echo (($_POST['semester'] ?? '') == $i) ? 'selected' : ''; ?>>
                                    Semester <?php echo $i; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ipk">IPK terakhir</label>
                        <input type="text" id="ipk" value="<?php echo IPK_MAHASISWA; ?>" readonly>
                    </div>

                    <div class="form-group" id="beasiswaGroup" <?php echo (IPK_MAHASISWA < 3) ? 'style="display: none;"' : ''; ?>>
                        <label for="pilihan_beasiswa">Pilihan Beasiswa</label>
                        <select id="pilihan_beasiswa" name="pilihan_beasiswa" <?php echo (IPK_MAHASISWA < 3) ? 'disabled' : 'required'; ?>>
                            <option value="">Pilihan Beasiswa</option>
                            <option value="Beasiswa Akademik" <?php echo (($_POST['pilihan_beasiswa'] ?? '') == 'Beasiswa Akademik') ? 'selected' : ''; ?>>
                                Beasiswa Akademik
                            </option>
                            <option value="Beasiswa Non-Akademik" <?php echo (($_POST['pilihan_beasiswa'] ?? '') == 'Beasiswa Non-Akademik') ? 'selected' : ''; ?>>
                                Beasiswa Non-Akademik
                            </option>
                            <option value="Beasiswa Prestasi" <?php echo (($_POST['pilihan_beasiswa'] ?? '') == 'Beasiswa Prestasi') ? 'selected' : ''; ?>>
                                Beasiswa Prestasi
                            </option>
                        </select>
                    </div>

                    <div class="form-group" id="berkasGroup" <?php echo (IPK_MAHASISWA < 3) ? 'style="display: none;"' : ''; ?>>
                        <label for="berkas">Upload Berkas Syarat</label>
                        <input type="file" id="berkas" name="berkas" accept=".pdf,.jpg,.jpeg,.png,.zip,.doc,.docx" <?php echo (IPK_MAHASISWA < 3) ? 'disabled' : 'required'; ?>>
                        <small>Format yang diizinkan: PDF, JPG, PNG, ZIP, DOC, DOCX</small>
                    </div>

                    <div class="form-actions">
                        <button type="submit" id="daftarBtn" <?php echo (IPK_MAHASISWA < 3) ? 'disabled class="disabled"' : ''; ?>>
                            Daftar
                        </button>
                        <button type="reset" onclick="resetForm()">Batal</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="script.js"></script>
</body>
</html>