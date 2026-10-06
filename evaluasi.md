# Evaluasi Sistem WikCup vs DBL

Secara keseluruhan, struktur database dan konsep sistem `WikCup` yang sudah kamu buat ini **sangat mirip** dan sudah on-track dengan sistem **DBL (Development Basketball League)**. Kamu sudah memikirkan pencatatan statistik mendetail yang menjadi ciri khas DBL.

Berikut adalah analisis kemiripan dan beberapa hal yang bisa dievaluasi atau ditambahkan untuk membuatnya setara dengan DBL:

## ✅ Apa yang Sudah Sangat Mirip dengan DBL:

1.  **Detail Statistik Pemain (`tr_statistics`)**
    Ini adalah nilai jual utama sistemmu! Seperti DBL, kamu tidak hanya mencetak skor akhir, tetapi juga mencatat statistik individu per pertandingan secara lengkap:
    *   *Points, Rebounds, Assists, Steals, Blocks, Turnovers*
    *   *Field Goals (FGM/FGA), 3-Points, 2-Points, Free Throws*
    *   *Minutes Played & Plus/Minus*
    *(Ini memungkinkan kamu membuat fitur "Player of the Match" atau "Top Leaderboard" seperti di web DBL).*
2.  **Detail Profil Pemain (`ms_players`)**
    Sama seperti DBL, setiap pemain memiliki profil khusus yang menampilkan atribut fisik dan identitas:
    *   *Posisi, Nomor Punggung, Tinggi Badan (Tinggi), Berat Badan, Kelas, Status Kapten, Gender*
3.  **Manajemen Pertandingan (`tr_matches`)**
    Sistem sudah mendukung pencatatan jadwal (tanggal, jam), lokasi, dan skor akhir dari dua tim yang bertanding.
4.  **Galeri Pertandingan (`tr_galleries`)**
    DBL selalu memiliki dokumentasi foto per pertandingan. Sistemmu sudah menghubungkan foto dengan spesifik pertandingan (`id_match`).

---

## 🚧 Apa yang Belum Ada (Saran Evaluasi / Penambahan):

Meskipun fondasinya sudah kuat, ada beberapa konsep di DBL yang belum ter-cover dalam sistem ini. Berikut adalah evaluasi yang perlu dipertimbangkan:

### 1. Entitas "Sekolah" (School) vs "Tim" (Team)
Di database-mu saat ini, nama sekolah digabung menjadi nama tim (contoh: `SMK Wikrama Thunder`).
*   **Di DBL:** Ada pemisahan antara `Sekolah` dan `Tim`. Satu Sekolah bisa memiliki Tim Basket Putra, Tim Basket Putri, Tim Dance, atau Suporter.
*   **Saran:** Jika sistem ini akan berkembang besar, buat tabel `ms_schools`, lalu di tabel `ms_teams` beri relasi `id_school` dan `gender_tim` (Putra/Putri).

### 2. Berita dan Artikel (News)
*   **Di DBL:** Halaman utama selalu dipenuhi oleh artikel berita liputan pertandingan (rekap pertandingan, cerita pemain, dll).
*   **Evaluasi:** Saat ini kamu belum memiliki tabel `tr_articles` atau `tr_news`. Kamu perlu tabel ini untuk media liputan.

### 3. Tabel Klasemen (Standings) / Fase Turnamen
*   **Di DBL:** Terdapat sistem Grup/Grup Stage atau Bracket (Bagan Turnamen) untuk sistem gugur.
*   **Evaluasi:** Di tabel `tr_matches`, belum ada indikator apakah pertandingan tersebut adalah babak penyisihan grup, semifinal, atau final (`stage` / `match_type`).

### 4. Sistem Live Score / Play-by-play (Opsional tapi Keren)
*   **Di DBL:** Saat pertandingan berlangsung, pengunjung web bisa melihat teks update (contoh: *"Menit 1: Rizky (Wikrama) mencetak 3-point"*).
*   **Evaluasi:** Ini butuh tabel `tr_play_by_play`. Tapi untuk MVP (Minimum Viable Product), fitur ini bisa ditunda dulu karena butuh petugas lapangan yang sangat reaktif.

### 5. Tim Dance / Suporter
*   **Di DBL:** DBL bukan cuma basket, tapi juga kompetisi Dance (UBS Gold Dance) dan Suporter (Best Supporter).
*   **Evaluasi:** Tergantung dari event WikCup, apakah hanya basket murni atau ada kompetisi lain. Jika ada, perlu ditambahkan tabelnya.

---

**Kesimpulan:**
Konsep intinya **sudah 85% mirip** dengan fungsionalitas utama aplikasi statistik DBL. Jika kamu menambahkan sistem "Berita/Artikel", web kamu sudah bisa berfungsi persis layaknya portal media DBL!
