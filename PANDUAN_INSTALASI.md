# 📋 PANDUAN INSTALASI LENGKAP
## Sistem Pendaftaran Beasiswa dengan XAMPP dan Visual Studio Code

---

## 🎯 LANGKAH 1: PERSIAPAN TOOLS

### A. Download XAMPP
1. **Buka browser** dan kunjungi: https://www.apachefriends.org/
2. **Klik "Download"** untuk sistem operasi Anda:
   - Windows: `xampp-windows-x64-8.2.12-0-VS16-installer.exe`
   - macOS: `xampp-osx-8.2.12-0-installer.dmg`
   - Linux: `xampp-linux-x64-8.2.12-0-installer.run`

### B. Download Visual Studio Code
1. **Kunjungi**: https://code.visualstudio.com/
2. **Klik "Download for [OS]"**
3. **Pilih versi** sesuai sistem operasi Anda

---

## 🛠️ LANGKAH 2: INSTALASI XAMPP

### Windows:
1. **Jalankan installer** XAMPP sebagai Administrator
2. **Pilih komponen** yang akan diinstall:
   - ✅ Apache
   - ✅ MySQL
   - ✅ PHP
   - ✅ phpMyAdmin
   - ❌ Mercury (tidak perlu)
   - ❌ Tomcat (tidak perlu)
3. **Pilih folder instalasi**: `C:\xampp` (default)
4. **Klik "Next"** hingga selesai
5. **Centang "Do you want to start the Control Panel now?"**

### macOS:
1. **Buka file DMG** yang sudah didownload
2. **Drag XAMPP** ke folder Applications
3. **Buka Terminal** dan jalankan:
   ```bash
   sudo /Applications/XAMPP/xamppfiles/xampp start
   ```

### Linux:
1. **Buka Terminal** dan navigasi ke folder download
2. **Berikan permission executable**:
   ```bash
   chmod +x xampp-linux-x64-8.2.12-0-installer.run
   ```
3. **Jalankan installer**:
   ```bash
   sudo ./xampp-linux-x64-8.2.12-0-installer.run
   ```

---

## 🎨 LANGKAH 3: INSTALASI VISUAL STUDIO CODE

### Windows:
1. **Jalankan installer** VS Code
2. **Accept License Agreement**
3. **Pilih lokasi instalasi** (default: `C:\Program Files\Microsoft VS Code`)
4. **Centang semua opsi**:
   - ✅ Add "Open with Code" action to Windows Explorer file context menu
   - ✅ Add "Open with Code" action to Windows Explorer directory context menu
   - ✅ Register Code as an editor for supported file types
   - ✅ Add to PATH
5. **Klik "Install"**

### macOS/Linux:
1. **Install** sesuai dengan cara standar OS masing-masing
2. **Pastikan VS Code** bisa dijalankan dari terminal dengan command `code`

---

## ⚙️ LANGKAH 4: KONFIGURASI XAMPP

### A. Start XAMPP Control Panel
**Windows**: Cari "XAMPP Control Panel" di Start Menu
**macOS/Linux**: Jalankan dari terminal atau aplikasi

### B. Start Services
1. **Klik "Start"** pada **Apache** ✅
2. **Klik "Start"** pada **MySQL** ✅ (opsional, jika perlu database)
3. **Pastikan status** menunjukkan "Running" dengan background hijau

### C. Test Installation
1. **Buka browser**
2. **Kunjungi**: http://localhost
3. **Anda akan melihat** halaman welcome XAMPP
4. **Klik "phpInfo()"** untuk memastikan PHP berjalan dengan baik

---

## 📁 LANGKAH 5: SETUP PROJECT

### A. Lokasi Folder Project
**Windows**: `C:\xampp\htdocs\`
**macOS**: `/Applications/XAMPP/xamppfiles/htdocs/`
**Linux**: `/opt/lampp/htdocs/`

### B. Membuat Folder Project
1. **Buka File Explorer/Finder**
2. **Navigasi** ke folder htdocs
3. **Buat folder baru**: `beasiswa-app`
4. **Path lengkap**: `C:\xampp\htdocs\beasiswa-app\` (Windows)

### C. Download/Copy Files Project
**Copy semua file berikut ke folder `beasiswa-app`:**
- `index.php` (halaman utama)
- `hasil.php` (halaman hasil)
- `clear_session.php` (hapus session)
- `style.css` (styling)
- `script.js` (JavaScript)
- `README.md` (dokumentasi)

---

## 💻 LANGKAH 6: BUKA PROJECT DI VS CODE

### A. Buka VS Code
1. **Jalankan Visual Studio Code**
2. **Klik "File" → "Open Folder"**
3. **Pilih folder**: `C:\xampp\htdocs\beasiswa-app\`
4. **Klik "Select Folder"**

### B. Install Extensions (Opsional tapi Recommended)
1. **Klik icon Extensions** (Ctrl+Shift+X)
2. **Install extensions berikut**:
   - **PHP Intelephense** (untuk PHP autocomplete)
   - **Live Server** (untuk preview HTML)
   - **Prettier** (untuk format code)
   - **Auto Rename Tag** (untuk HTML/XML)
   - **Bracket Pair Colorizer** (untuk highlight brackets)

---

## 🔧 LANGKAH 7: KONFIGURASI PROJECT

### A. Buat Folder Upload
1. **Di VS Code**, klik kanan di explorer
2. **New Folder** → nama: `uploads`
3. **Atau via terminal**:
   ```bash
   mkdir uploads
   chmod 777 uploads  # Linux/macOS
   ```

### B. Set Permissions (Linux/macOS)
```bash
# Berikan write permission untuk upload folder
sudo chmod -R 777 /opt/lampp/htdocs/beasiswa-app/uploads/

# Set ownership (opsional)
sudo chown -R www-data:www-data /opt/lampp/htdocs/beasiswa-app/
```

### C. Konfigurasi PHP (Opsional)
**Edit file `php.ini` jika perlu mengubah setting upload:**

**Lokasi php.ini:**
- Windows: `C:\xampp\php\php.ini`
- macOS: `/Applications/XAMPP/xamppfiles/etc/php.ini`
- Linux: `/opt/lampp/etc/php.ini`

**Setting yang perlu dicek:**
```ini
file_uploads = On
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 60
memory_limit = 128M
```

---

## 🚀 LANGKAH 8: TESTING APPLICATION

### A. Start XAMPP Services
1. **Buka XAMPP Control Panel**
2. **Pastikan Apache running** (hijau)
3. **MySQL opsional** (jika ingin menggunakan database)

### B. Akses Application
1. **Buka browser**
2. **Kunjungi**: http://localhost/beasiswa-app/
3. **Anda akan melihat** form pendaftaran beasiswa

### C. Test Functionality
1. **Test IPK ≥ 3**: Pastikan form aktif dan auto-focus ke pilihan beasiswa
2. **Test IPK < 3**: Ubah konstanta IPK di `index.php` menjadi 2.9
3. **Test validasi email**: Masukkan email invalid
4. **Test validasi HP**: Masukkan selain angka
5. **Test upload**: Upload file dengan format yang diizinkan
6. **Test submit**: Isi form lengkap dan submit

---

## 🔍 TROUBLESHOOTING

### Problem 1: Apache Tidak Start
**Penyebab**: Port 80 sudah digunakan aplikasi lain
**Solusi**:
1. **Klik "Config"** di samping Apache
2. **Pilih "httpd.conf"**
3. **Cari baris**: `Listen 80`
4. **Ganti menjadi**: `Listen 8080`
5. **Save dan restart Apache**
6. **Akses via**: http://localhost:8080/beasiswa-app/

### Problem 2: File Upload Error
**Solusi**:
1. **Cek folder `uploads/` ada dan writable**
2. **Set permission 777** (Linux/macOS)
3. **Cek php.ini** untuk upload settings
4. **Restart Apache** setelah edit php.ini

### Problem 3: Session Error
**Solusi**:
1. **Cek folder session** di XAMPP writable
2. **Restart browser** (clear cache)
3. **Restart Apache**

### Problem 4: JavaScript Error
**Solusi**:
1. **Buka Developer Tools** (F12)
2. **Cek Console** untuk error messages
3. **Pastikan file `script.js`** ter-load dengan benar

---

## 📝 LANGKAH 9: DEVELOPMENT WORKFLOW

### A. Edit Files
1. **Buka VS Code** dengan project folder
2. **Edit file** sesuai kebutuhan
3. **Save** dengan Ctrl+S
4. **Refresh browser** untuk melihat perubahan

### B. Debug Process
1. **Gunakan browser Developer Tools** (F12)
2. **PHP errors** akan muncul di halaman
3. **JavaScript errors** di Console
4. **Network tab** untuk debug AJAX/Upload

### C. Version Control (Opsional)
```bash
# Initialize git repository
git init
git add .
git commit -m "Initial commit"

# Atau connect ke GitHub
git remote add origin https://github.com/username/beasiswa-app.git
git push -u origin main
```

---

## ✅ CHECKLIST AKHIR

**Pastikan semua langkah berikut sudah selesai:**

- [ ] XAMPP terinstall dan Apache running
- [ ] Visual Studio Code terinstall
- [ ] Project folder di `htdocs/beasiswa-app/`
- [ ] Folder `uploads/` sudah dibuat dan writable
- [ ] Akses http://localhost/beasiswa-app/ berhasil
- [ ] Form validation berfungsi (email, HP)
- [ ] IPK validation berfungsi (3.4 aktif, 2.9 disabled)
- [ ] Upload file berfungsi
- [ ] Submit form redirect ke halaman hasil
- [ ] Status ajuan menampilkan "belum di verifikasi"
- [ ] Print functionality berfungsi

---

## 🎉 SELAMAT!

**Aplikasi Sistem Pendaftaran Beasiswa sudah siap digunakan!**

**Untuk testing lanjutan:**
1. Coba ubah IPK konstanta untuk testing skenario berbeda
2. Test dengan berbagai format file upload
3. Test responsive design di mobile device
4. Customize styling sesuai kebutuhan

**Untuk deployment ke server production:**
1. Upload semua files ke web hosting
2. Set permission folder uploads
3. Update database connection (jika diperlukan)
4. Test di environment production

---

### 📞 SUPPORT

Jika ada pertanyaan atau masalah:
1. **Cek README.md** untuk dokumentasi lengkap
2. **Cek browser Console** untuk JavaScript errors
3. **Cek XAMPP logs** untuk PHP errors
4. **Cek file permissions** untuk upload issues

**Happy Coding! 🚀**