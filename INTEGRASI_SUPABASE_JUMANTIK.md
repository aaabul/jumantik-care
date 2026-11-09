# Integrasi Supabase — Aplikasi Jumantik

## Kondisi project

- Laravel 13
- Vue 3 + Inertia.js + Tailwind CSS (bukan Blade)
- Enam model Eloquent diarahkan ke koneksi bernama `supabase`:
  `WilayahRw`, `Wilayah`, `Profile`, `Rumah`, `Pemeriksaan`, `TindakLanjut`.
- Koneksi default Laravel tetap SQLite untuk autentikasi starter kit dan tabel internal Laravel.
- Dashboard mengambil ringkasan data dari Supabase secara read-only.

## Menghubungkan ke Supabase

1. Salin `.env.example` menjadi `.env` jika `.env` belum ada.
2. Buka Supabase Dashboard → Project Settings → Database → Connection string.
3. Pilih connection string PostgreSQL yang sesuai. Untuk jaringan lokal, gunakan Session Pooler bila direct connection tidak dapat dijangkau.
4. Isi variabel `SUPABASE_DB_HOST`, `SUPABASE_DB_PORT`, `SUPABASE_DB_DATABASE`, `SUPABASE_DB_USERNAME`, dan `SUPABASE_DB_PASSWORD` di `.env`.
5. Pertahankan `SUPABASE_DB_SSLMODE=require`.
6. Jangan commit `.env`, password database, service-role key, atau secret key.
7. Pastikan PHP mengaktifkan ekstensi `pdo_pgsql`.
8. Jalankan `php artisan config:clear`, lalu `php artisan serve` dan buka `/dashboard`.

Contoh variabel (bukan kredensial sungguhan):

```dotenv
DB_CONNECTION=sqlite
SUPABASE_DB_HOST=your-project-pooler-host
SUPABASE_DB_PORT=5432
SUPABASE_DB_DATABASE=postgres
SUPABASE_DB_USERNAME=postgres.your-project-ref
SUPABASE_DB_PASSWORD=your-database-password
SUPABASE_DB_SSLMODE=require
```

## Penting sebelum dipakai

- Jangan menjalankan `php artisan migrate` ke database Supabase. Migration bawaan starter kit membuat tabel `users`, `sessions`, dan tabel Laravel lain yang bukan bagian dari skema Jumantik.
- Login/register bawaan Laravel Fortify saat ini masih memakai tabel `users` lokal (SQLite). Ini BELUM Supabase Auth dan belum dipetakan ke `auth.users` / `public.profiles`.
- Koneksi PostgreSQL backend menggunakan kredensial database server. Koneksi langsung seperti ini dapat melewati RLS Supabase bila memakai role database yang memiliki bypass RLS. Karena itu, jangan pernah mengirim kredensial database ke browser. Sebelum aplikasi dipakai sungguhan, otorisasi role (`petugas`, `ketua_jumantik`, `koordinator`) wajib diterapkan dan diuji di backend, atau autentikasi Supabase JWT diintegrasikan secara benar.
- Model mengikuti nama kolom yang diberikan pada skema saat ini. Tabel `profiles` menggunakan UUID sebagai primary key dan tidak memiliki `updated_at`; model sudah disesuaikan.
- Dashboard saat ini hanya ringkasan baca data, belum CRUD seluruh modul.

## Struktur tabel yang dipetakan

| Tabel Supabase | Model Laravel |
|---|---|
| `wilayah_rw` | `WilayahRw` |
| `wilayah` | `Wilayah` |
| `profiles` | `Profile` |
| `rumah` | `Rumah` |
| `pemeriksaan` | `Pemeriksaan` |
| `tindak_lanjut` | `TindakLanjut` |
