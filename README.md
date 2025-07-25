# Sistem Pendaftaran Beasiswa Kampus Kuaja

Aplikasi web untuk pendaftaran beasiswa dengan validasi IPK, form validation, dan upload berkas syarat.

## Fitur Utama

- ✅ Validasi IPK otomatis (konstanta 3.4)
- ✅ Form validasi real-time (email, nomor HP)
- ✅ Semester selection (1-8 untuk S1)
- ✅ Upload berkas syarat (PDF, JPG, PNG, ZIP, DOC, DOCX)
- ✅ Auto-disable form jika IPK < 3.0
- ✅ Auto-focus ke pilihan beasiswa jika IPK ≥ 3.0
- ✅ Status ajuan "belum di verifikasi"
- ✅ Halaman hasil pendaftaran lengkap
- ✅ Responsive design
- ✅ Print functionality

## Persyaratan Sistem

- PHP 7.4+ 
- Web Server (Apache/Nginx)
- XAMPP (recommended untuk development)
- Browser modern (Chrome, Firefox, Safari, Edge)

## Cara Instalasi dengan XAMPP

### 1. Download dan Install XAMPP
- Download XAMPP dari [https://www.apachefriends.org/](https://www.apachefriends.org/)
- Install XAMPP di komputer Anda
- Jalankan XAMPP Control Panel

### 2. Start Services
- Buka XAMPP Control Panel
- Klik "Start" pada Apache
- Pastikan Apache berjalan (lampu hijau)

### 3. Setup Project
```bash
# Clone atau copy files ke folder htdocs
cd C:\xampp\htdocs\  # Windows
# atau
cd /opt/lampp/htdocs/  # Linux

# Buat folder project
mkdir beasiswa-app
cd beasiswa-app

# Copy semua files project ke folder ini
# - index.php
# - hasil.php
# - clear_session.php
# - style.css
# - script.js
```

### 4. Buat Folder Upload
```bash
# Buat folder untuk upload berkas
mkdir uploads
# Set permission (Linux/Mac)
chmod 777 uploads
```

### 5. Akses Aplikasi
- Buka browser
- Kunjungi: `http://localhost/beasiswa-app/`

## Struktur File

```
beasiswa-app/
├── index.php          # Halaman utama form pendaftaran
├── hasil.php           # Halaman hasil pendaftaran
├── clear_session.php   # Script hapus session
├── style.css           # Styling CSS
├── script.js           # JavaScript validation
├── uploads/            # Folder upload berkas (auto-created)
└── README.md          # Dokumentasi
```

## Cara Penggunaan

### 1. Akses Form Pendaftaran
- Buka `http://localhost/beasiswa-app/`
- IPK akan muncul otomatis (konstanta 3.4)

### 2. Isi Data Pendaftaran
- **Nama**: Masukkan nama lengkap
- **Email**: Format email valid (contoh: user@email.com)
- **Nomor HP**: Hanya angka, minimal 10 digit
- **Semester**: Pilih 1-8
- **IPK**: Otomatis tampil (konstanta)

### 3. Validasi IPK
- **IPK ≥ 3.0**: Form aktif, auto-focus ke pilihan beasiswa
- **IPK < 3.0**: Form disabled, tidak bisa lanjut

### 4. Pilihan Beasiswa & Upload
- Pilih jenis beasiswa
- Upload berkas syarat (max 5MB)
- Format: PDF, JPG, PNG, ZIP, DOC, DOCX

### 5. Submit & Hasil
- Klik "Daftar" untuk submit
- Redirect ke halaman hasil
- Status ajuan: "belum di verifikasi"

## Testing Skenario

### Test 1: IPK Memenuhi Syarat (3.4)
1. Isi semua field dengan benar
2. Upload berkas valid
3. Submit form
4. Cek hasil pendaftaran

### Test 2: IPK Tidak Memenuhi Syarat
1. Ubah konstanta IPK menjadi 2.9 di `index.php` line 5
2. Reload halaman
3. Pastikan form disabled

### Test 3: Validasi Email
1. Masukkan email invalid (contoh: "test")
2. Lihat error message real-time
3. Masukkan email valid
4. Error hilang

### Test 4: Validasi HP
1. Masukkan huruf di field HP
2. Input otomatis ditolak
3. Masukkan angka < 10 digit
4. Lihat error message

## Customization

### Mengubah IPK Default
Edit file `index.php` line 5:
```php
define('IPK_MAHASISWA', 2.9); // Untuk testing IPK rendah
define('IPK_MAHASISWA', 3.8); // Untuk testing IPK tinggi
```

### Menambah Jenis Beasiswa
Edit `index.php` pada bagian select option:
```php
<option value="Beasiswa Baru">Beasiswa Baru</option>
```

### Mengubah Maksimal File Upload
Edit `script.js` dan sesuaikan dengan `php.ini`:
```javascript
if (berkas.size > 10 * 1024 * 1024) { // 10MB
```

## Troubleshooting

### File Upload Error
- Pastikan folder `uploads/` ada dan writable
- Cek `php.ini` untuk `upload_max_filesize` dan `post_max_size`
- Set permission folder: `chmod 777 uploads/`

### Session Not Working
- Pastikan PHP session enabled
- Cek `php.ini` untuk session configuration
- Restart Apache setelah config change

### Form Tidak Submit
- Cek JavaScript errors di browser console
- Pastikan semua field required terisi
- Cek validasi client-side

## Fitur Tambahan

- **Print**: Tombol cetak bukti pendaftaran
- **Reset**: Bersihkan form dengan konfirmasi
- **Auto-save**: Data tersimpan di session
- **Responsive**: Mobile-friendly design
- **Keyboard shortcuts**: Ctrl+Enter (submit), Ctrl+R (reset)

## Browser Support

- ✅ Chrome 80+
- ✅ Firefox 75+
- ✅ Safari 13+
- ✅ Edge 80+

## Security Features

- Input sanitization dengan `htmlspecialchars()`
- File type validation
- File size limitation
- CSRF protection via session
- XSS prevention

## Lisensi

MIT License - Bebas digunakan untuk tujuan pendidikan dan komersial.
