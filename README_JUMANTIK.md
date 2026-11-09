# Jumantik Care — versi perombakan awal

Project ini tetap menggunakan Laravel 13, Vue 3, Inertia, dan Supabase.

## Role aplikasi

- `petugas`: input hasil pemeriksaan untuk rumah pada `wilayah_id` miliknya.
- `ketua_jumantik`: melihat pemeriksaan dan ringkasan pada `rw_id` miliknya.
- `koordinator`: melihat ringkasan lintas RW.

Nilai role disimpan di `public.profiles.role` dan identitas profil harus memakai UUID yang sama dengan `auth.users.id`.

## Menyiapkan project

1. Ekstrak ZIP ke folder project baru. Jangan menimpa folder project asli sebelum backup.
2. Salin `.env.example` menjadi `.env`.
3. Isi `APP_KEY` (jalankan `php artisan key:generate`).
4. Isi `SUPABASE_URL` dan `SUPABASE_ANON_KEY` dari Supabase Project Settings → API.
5. Isi `SUPABASE_DB_HOST`, `SUPABASE_DB_PORT`, `SUPABASE_DB_DATABASE`, `SUPABASE_DB_USERNAME`, dan `SUPABASE_DB_PASSWORD` dari connection string PostgreSQL Supabase. Jangan masukkan kredensial ini ke Git atau kirim ke siapa pun.
6. Pastikan ekstensi PHP `pdo_pgsql` aktif.
7. Jalankan `composer install` dan `npm install`.
8. Jalankan `php artisan config:clear`.
9. Jalankan `npm run dev` dan `php artisan serve` pada terminal terpisah.
10. Buka `http://127.0.0.1:8000`.

## Halaman yang tersedia

- `/login`: login menggunakan Supabase Auth password grant.
- `/dashboard`: dashboard disesuaikan dengan role.
- `/pemeriksaan`: daftar pemeriksaan yang dibatasi sesuai role.
- `/pemeriksaan/create`: formulir input khusus Petugas Jumantik.

## Catatan integrasi dan batasan versi ini

- Jangan menjalankan `php artisan migrate` terhadap database Supabase. Skema Supabase yang ada dipakai apa adanya.
- Login memvalidasi password ke Supabase Auth, lalu memuat profil dari `public.profiles`. Akun harus mempunyai baris profil dengan `id` sama dengan `auth.users.id`.
- Laravel memakai koneksi PostgreSQL server-side untuk membaca/menulis tabel `public`. Kredensial database tidak boleh dikirim ke browser. Karena koneksi server-side bisa memiliki hak akses lebih tinggi daripada RLS, aplikasi ini membatasi query berdasarkan role di backend. Sebelum penggunaan produksi, uji kebijakan RLS dan hak database dengan teliti.
- Form pemeriksaan saat ini mencatat rumah, tanggal, hasil jentik, dan catatan. Checklist 3M Plus, unggah foto, tanda tangan, export Excel, verifikasi berjenjang, serta pengelolaan master rumah belum dibuat pada tahap ini.
- Akun Ketua Jumantik harus mempunyai `rw_id`. Akun Petugas Jumantik harus mempunyai `wilayah_id`. Akun Koordinator tidak dibatasi ke RW tertentu.
- Jika tabel/kolom di Supabase berbeda dari struktur yang didokumentasikan, sesuaikan query setelah memeriksa skema aktual; jangan menebak atau mengubah skema produksi secara langsung.
