
<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Pengaturan Keamanan" />

    <div class="space-y-4">
        <h1 class="text-2xl font-semibold">
            Pengaturan Keamanan
        </h1>

        <p class="text-muted-foreground">
            Pengelolaan keamanan akun dilakukan melalui administrator
            sistem Jumantik.
        </p>

        <Link href="/dashboard" class="underline underline-offset-4">
            Kembali ke Dashboard
        </Link>
    </div>
</template>
