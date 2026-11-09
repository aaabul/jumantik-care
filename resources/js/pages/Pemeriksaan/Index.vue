<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
defineProps<{ items: Array<{ id: number; rumah_id: number; tanggal_pemeriksaan: string; hasil_jentik: string; catatan: string | null }> }>();
</script>
<template>
    <Head title="Data Pemeriksaan" />
    <main class="space-y-5 p-4 md:p-6">
        <header class="flex flex-wrap items-center justify-between gap-3"><div><p class="text-sm text-emerald-700">Pelaporan Jumantik</p><h1 class="text-2xl font-bold">Data Pemeriksaan</h1><p class="mt-1 text-sm text-muted-foreground">Daftar pemeriksaan sesuai wilayah kewenangan akun.</p></div><Link href="/dashboard" class="rounded-lg border px-4 py-2 text-sm">Kembali ke dashboard</Link></header>
        <section class="overflow-x-auto rounded-xl border bg-card p-4"><table class="w-full text-left text-sm"><thead><tr class="border-b text-muted-foreground"><th class="p-3">Tanggal</th><th class="p-3">ID Rumah</th><th class="p-3">Hasil Jentik</th><th class="p-3">Catatan</th></tr></thead><tbody><tr v-for="item in items" :key="item.id" class="border-b last:border-0"><td class="p-3">{{ item.tanggal_pemeriksaan }}</td><td class="p-3">{{ item.rumah_id }}</td><td class="p-3">{{ item.hasil_jentik }}</td><td class="p-3">{{ item.catatan || '—' }}</td></tr><tr v-if="!items.length"><td colspan="4" class="p-6 text-center text-muted-foreground">Belum ada data pemeriksaan.</td></tr></tbody></table></section>
    </main>
</template>
