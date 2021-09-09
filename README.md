## SI CUTKAR
Sistem Informasi Cuti Karyawan adalah aplikasi untuk mengelola cuti karyawan.

Adapun beberapa user dan otorisasinya
1. Super Admin :
    - Menambah data karyawan
    - Menambah staf HR
    - Konfigurasi total cuti karyawan dalam setahun
    - Menyetujui Cuti
2. Staf HR :
    - Menambah data karyawan
    - Konfigurasi total cuti karyawan dalam setahun
    - Menyetujui Cuti
3. Karyawan :
    - Melihat sisa cuti
    - Dapat mengajukan cuti jika masih ada jatah


## Langkah Install
1. Import si_cuti.sql yang ada di direktori root karena saya tidak menggunakan otomatis migrasi
2. Setup db di .env
3. Jalankan php artisan serve 