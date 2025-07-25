// Validasi form real-time
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    const emailInput = document.getElementById('email');
    const hpInput = document.getElementById('hp');
    const semesterSelect = document.getElementById('semester');
    const pilihan_beasiswaSelect = document.getElementById('pilihan_beasiswa');
    
    // Validasi email real-time
    emailInput.addEventListener('input', function() {
        validateEmail(this.value);
    });
    
    // Validasi HP real-time
    hpInput.addEventListener('input', function() {
        validateHP(this.value);
    });
    
    // Auto-focus ke pilihan beasiswa jika IPK >= 3
    window.addEventListener('load', function() {
        const ipkValue = parseFloat(document.getElementById('ipk').value);
        if (ipkValue >= 3 && pilihan_beasiswaSelect && !pilihan_beasiswaSelect.disabled) {
            setTimeout(() => {
                pilihan_beasiswaSelect.focus();
            }, 500);
        }
    });
    
    // Submit form validation
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
                return false;
            }
        });
    }
});

// Fungsi validasi email
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const emailError = document.getElementById('emailError');
    
    if (email === '') {
        emailError.style.display = 'none';
        return true;
    }
    
    if (!emailRegex.test(email)) {
        emailError.textContent = 'Format email tidak valid';
        emailError.style.display = 'block';
        return false;
    } else {
        emailError.style.display = 'none';
        return true;
    }
}

// Fungsi validasi HP
function validateHP(hp) {
    const hpRegex = /^[0-9]+$/;
    const hpError = document.getElementById('hpError');
    
    if (hp === '') {
        hpError.style.display = 'none';
        return true;
    }
    
    if (!hpRegex.test(hp)) {
        hpError.textContent = 'Nomor HP hanya boleh berisi angka';
        hpError.style.display = 'block';
        return false;
    } else if (hp.length < 10) {
        hpError.textContent = 'Nomor HP minimal 10 digit';
        hpError.style.display = 'block';
        return false;
    } else if (hp.length > 15) {
        hpError.textContent = 'Nomor HP maksimal 15 digit';
        hpError.style.display = 'block';
        return false;
    } else {
        hpError.style.display = 'none';
        return true;
    }
}

// Fungsi validasi form lengkap
function validateForm() {
    const nama = document.getElementById('nama').value.trim();
    const email = document.getElementById('email').value.trim();
    const hp = document.getElementById('hp').value.trim();
    const semester = document.getElementById('semester').value;
    const ipk = parseFloat(document.getElementById('ipk').value);
    
    let isValid = true;
    let errorMessage = '';
    
    // Validasi nama
    if (nama === '') {
        errorMessage += '- Nama harus diisi\n';
        isValid = false;
    }
    
    // Validasi email
    if (email === '') {
        errorMessage += '- Email harus diisi\n';
        isValid = false;
    } else if (!validateEmail(email)) {
        errorMessage += '- Format email tidak valid\n';
        isValid = false;
    }
    
    // Validasi HP
    if (hp === '') {
        errorMessage += '- Nomor HP harus diisi\n';
        isValid = false;
    } else if (!validateHP(hp)) {
        errorMessage += '- Format nomor HP tidak valid\n';
        isValid = false;
    }
    
    // Validasi semester
    if (semester === '') {
        errorMessage += '- Semester harus dipilih\n';
        isValid = false;
    }
    
    // Validasi IPK
    if (ipk < 3) {
        errorMessage += '- IPK minimal 3.0 untuk mendaftar beasiswa\n';
        isValid = false;
    } else {
        // Validasi pilihan beasiswa dan berkas jika IPK >= 3
        const pilihan_beasiswa = document.getElementById('pilihan_beasiswa').value;
        const berkas = document.getElementById('berkas').files[0];
        
        if (pilihan_beasiswa === '') {
            errorMessage += '- Pilihan beasiswa harus dipilih\n';
            isValid = false;
        }
        
        if (!berkas) {
            errorMessage += '- Berkas syarat harus diupload\n';
            isValid = false;
        } else {
            // Validasi ukuran file (max 5MB)
            if (berkas.size > 5 * 1024 * 1024) {
                errorMessage += '- Ukuran berkas maksimal 5MB\n';
                isValid = false;
            }
            
            // Validasi tipe file
            const allowedTypes = [
                'application/pdf',
                'image/jpeg',
                'image/jpg',
                'image/png',
                'application/zip',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ];
            
            if (!allowedTypes.includes(berkas.type)) {
                errorMessage += '- Format berkas tidak diizinkan\n';
                isValid = false;
            }
        }
    }
    
    if (!isValid) {
        alert('Terdapat kesalahan dalam pengisian form:\n\n' + errorMessage);
    }
    
    return isValid;
}

// Fungsi reset form
function resetForm() {
    if (confirm('Apakah Anda yakin ingin mengosongkan semua data?')) {
        document.getElementById('registrationForm').reset();
        
        // Hide error messages
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(error => {
            error.style.display = 'none';
        });
        
        // Focus kembali ke nama
        document.getElementById('nama').focus();
    }
}

// Fungsi untuk restrict input HP hanya angka
document.addEventListener('DOMContentLoaded', function() {
    const hpInput = document.getElementById('hp');
    if (hpInput) {
        hpInput.addEventListener('keypress', function(e) {
            // Hanya izinkan angka (0-9)
            if (!/[0-9]/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab') {
                e.preventDefault();
            }
        });
        
        // Prevent paste non-numeric
        hpInput.addEventListener('paste', function(e) {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text');
            if (/^[0-9]+$/.test(paste)) {
                this.value = paste;
                validateHP(paste);
            }
        });
    }
});

// Smooth scrolling untuk form validation errors
function scrollToError(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
        element.focus();
    }
}

// Loading state untuk form submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    if (form) {
        form.addEventListener('submit', function() {
            const submitBtn = document.getElementById('daftarBtn');
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.textContent = 'Memproses...';
                submitBtn.disabled = true;
                
                // Re-enable setelah 10 detik jika ada error
                setTimeout(() => {
                    submitBtn.textContent = 'Daftar';
                    submitBtn.disabled = false;
                }, 10000);
            }
        });
    }
});

// Auto-fill demo (untuk testing)
function fillDemoData() {
    if (confirm('Isi data demo untuk testing?')) {
        document.getElementById('nama').value = 'John Doe';
        document.getElementById('email').value = 'john.doe@email.com';
        document.getElementById('hp').value = '08123456789';
        document.getElementById('semester').value = '4';
    }
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl + Enter untuk submit form
    if (e.ctrlKey && e.key === 'Enter') {
        const form = document.getElementById('registrationForm');
        if (form && validateForm()) {
            form.submit();
        }
    }
    
    // Ctrl + R untuk reset form
    if (e.ctrlKey && e.key === 'r') {
        e.preventDefault();
        resetForm();
    }
});