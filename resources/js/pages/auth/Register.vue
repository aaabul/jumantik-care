
<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Registrasi Dinonaktifkan" />

    <div class="flex min-h-screen flex-col items-center justify-center gap-4 p-6 text-center">
        <h1 class="text-2xl font-semibold">
            Registrasi Tidak Tersedia
        </h1>

        <p class="text-muted-foreground">
            Akun pengguna Jumantik dibuat oleh administrator.
        </p>

        <Link
            href="/login"
            class="underline underline-offset-4"
        >
            Kembali ke halaman login
        </Link>
    </div>
</template>
