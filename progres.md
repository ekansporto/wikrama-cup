# Progress & Ide Pengembangan WikCup Basketball

Dokumen ini berisi rekapitulasi ide-ide yang sudah dieksekusi dan konsep sistem yang diterapkan pada platform WikCup.

## 1. Sistem Statistik & Box Score
- **Ide:** Card pertandingan sekolah vs sekolah menampilkan nama pemain dari kedua tim, dan ada update statistik yang efisien (semua pemain dalam 1 halaman untuk sekali input).
- **Status:** **SELESAI**
- **Implementasi:**
  - Pembuatan fitur **Batch Statistics Input** di halaman Admin (`/admin/matches/{match}/stats`). 
  - Admin dapat melihat tabel bergaya spreadsheet yang berisi seluruh roster pemain dari Tim A dan Tim B.
  - Cukup sekali *submit*, seluruh poin, assist, rebound, dan statistik lainnya untuk setiap pemain akan langsung tersimpan dan terakumulasi secara otomatis di profil masing-masing pemain berkat relasi *dynamic attributes* (`getTotalPointsAttribute`, dsb) di model `Player.php`.
  - Di sisi penonton (Publik), halaman *Box Score* (Detail Hasil Pertandingan) menampilkan statistik tiap pemain di dalam pertandingan tersebut secara lengkap.

## 2. Pendaftaran Pemain & Manajemen Roster
- **Ide:** Daripada admin repot input data pemain satu per satu, data pemain dikelola dari mana?
- **Status:** **SELESAI**
- **Implementasi:**
  - Admin hanya bertugas membuat wadah **Tim** (nama tim dan logo).
  - Data pemain murni bersumber dari pendaftaran mandiri (Self-Registration).
  - Pemain membuat akun dan mengisi **Profil Pemain** mereka sendiri.
  - Saat mengisi profil, pemain dapat memilih dari *dropdown* Tim mana mereka bergabung. Setelah di-save, mereka otomatis masuk ke dalam *roster* Tim tersebut.

## 3. Perombakan Visual (UI/UX) - "Say No to AI Slop"
- **Ide:** UI awal terlihat kotor, kurang rapi, dan menggunakan gaya desain AI yang berlebihan (gradien, shadow berlebih, blur/glowing) yang tidak *user-friendly* atau profesional.
- **Status:** **SELESAI**
- **Implementasi:**
  - Mengubah gaya desain secara total ke arah **Flat/Minimalist Sports Analytics** (Brutalism/Corporate Sports).
  - Menghapus semua efek `blur-3xl`, `bg-gradient-to-`, dan `shadow-2xl` yang berlebihan.
  - Memanfaatkan *white space* (ruang kosong) agar data mudah dibaca.
  - Menggunakan kombinasi warna putih, abu-abu (`slate-50`, `slate-900`), dan **Oranye WikCup** sebagai warna aksen utama yang tajam (solid color, bukan gradien).
  - Diterapkan pada `home.blade.php`, navigasi publik (`app.blade.php`), hingga ke dalam panel Admin (`admin.blade.php`).

## 4. Perbaikan Tampilan Logo
- **Ide:** Logo tim (terutama format transparan PNG atau yang berdimensi panjang/lebar) sering terpotong kotak karena `object-cover`.
- **Status:** **SELESAI**
- **Implementasi:**
  - Mengubah seluruh `object-cover` menjadi `object-contain` pada semua elemen logo tim di seluruh file `.blade.php` (Home, Jadwal, Hasil, Tim, Panel Admin). 
  - Menjalankan `php artisan storage:link` sehingga gambar logo yang di-upload dari panel admin dapat diakses di server publik dan tidak lagi memunculkan kotak "fallback" inisial nama. Logo kini tampil 100% utuh persis seperti apa yang di-upload.

---
*Catatan: Dokumen ini dapat terus diupdate seiring dengan bertambahnya ide-ide baru.*
