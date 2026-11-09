<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

type Stats = { rumah: number; pemeriksaan: number; jentik_positif: number; tindak_lanjut_belum: number; petugas: number; wilayah_rw: number };
const props = defineProps<{ stats: Stats; role: string; roleLabel: string; supabaseConnected: boolean; connectionMessage: string | null; recent: Array<Record<string, any>> }>();
const cards = [
    { key: 'rumah', label: 'Rumah terdata' },
    { key: 'pemeriksaan', label: 'Total pemeriksaan' },
    { key: 'jentik_positif', label: 'Temuan jentik positif' },
    { key: 'tindak_lanjut_belum', label: 'Belum ditindaklanjuti' },
];
const titles: Record<string, string> = {
    petugas: 'Dashboard Petugas Jumantik',
    ketua_jumantik: 'Dashboard Ketua Jumantik',
    koordinator: 'Dashboard Koordinator Jumantik',
};
</script>

<template>
    <Head :title="titles[role] || 'Dashboard Jumantik'" />
    <main class="space-y-6 p-4 md:p-6">
        <header class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <p class="text-sm font-medium text-emerald-700">Sistem Informasi Pemeriksaan dan Pelaporan Jumantik</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight">{{ titles[role] }}</h1>
                <p class="mt-1 text-sm text-muted-foreground">Ringkasan aktivitas sesuai kewenangan {{ roleLabel }}.</p>
            </div>
            <span class="rounded-full border px-3 py-1.5 text-xs font-semibold" :class="supabaseConnected ? 'border-emerald-300 bg-emerald-50 text-emerald-800' : 'border-amber-300 bg-amber-50 text-amber-800'">
                {{ supabaseConnected ? 'Database terhubung' : 'Database belum terhubung' }}
            </span>
        </header>
        <div v-if="connectionMessage" class="rounded-lg border border-amber-300 bg-amber-50 p-4 text-sm text-amber-900">{{ connectionMessage }}</div>
        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <article v-for="card in cards" :key="card.key" class="rounded-xl border bg-card p-5 shadow-sm">
                <p class="text-sm text-muted-foreground">{{ card.label }}</p>
                <p class="mt-3 text-3xl font-bold tabular-nums">{{ stats[card.key as keyof Stats] }}</p>
            </article>
        </section>
        <section class="grid gap-4 lg:grid-cols-3">
            <article class="rounded-xl border bg-card p-5 lg:col-span-2">
                <h2 class="font-semibold">Alur pelaporan Jumantik</h2>
                <div class="mt-4 grid gap-3 sm:grid-cols-3">
                    <div class="rounded-lg bg-emerald-50 p-4 text-emerald-950"><p class="font-semibold">1. Petugas Jumantik</p><p class="mt-1 text-sm">Memeriksa rumah dan menginput hasil jentik serta kondisi 3M Plus.</p></div>
                    <div class="rounded-lg bg-sky-50 p-4 text-sky-950"><p class="font-semibold">2. Ketua Jumantik</p><p class="mt-1 text-sm">Mengumpulkan dan merekap laporan petugas di wilayah RW.</p></div>
                    <div class="rounded-lg bg-amber-50 p-4 text-amber-950"><p class="font-semibold">3. Koordinator</p><p class="mt-1 text-sm">Memantau rekap seluruh RW dan meneruskan laporan ke Puskesmas.</p></div>
                </div>
            </article>
            <article class="rounded-xl border bg-card p-5">
                <h2 class="font-semibold">Ringkasan kewenangan</h2>
                <p class="mt-2 text-sm leading-6 text-muted-foreground" v-if="role === 'petugas'">Data pemeriksaan yang ditampilkan dibatasi pada pemeriksaan yang dibuat oleh akun petugas ini.</p>
                <p class="mt-2 text-sm leading-6 text-muted-foreground" v-else-if="role === 'ketua_jumantik'">Data rumah, pemeriksaan, dan petugas dibatasi pada RW yang ditugaskan kepada Ketua Jumantik.</p>
                <p class="mt-2 text-sm leading-6 text-muted-foreground" v-else>Koordinator dapat memantau ringkasan seluruh RW dalam wilayah kelurahan.</p>
                <div v-if="role === 'petugas'" class="mt-4"><Link href="/pemeriksaan/create" class="inline-flex rounded-lg bg-emerald-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-800">Input pemeriksaan</Link></div>
            </article>
        </section>
        <section class="rounded-xl border bg-card p-5">
            <div class="flex items-center justify-between gap-3"><h2 class="font-semibold">Pemeriksaan terbaru</h2><Link v-if="role !== 'petugas'" href="/pemeriksaan" class="text-sm font-medium text-emerald-700 hover:underline">Lihat daftar</Link></div>
            <div v-if="recent.length" class="mt-4 overflow-x-auto"><table class="w-full text-left text-sm"><thead><tr class="border-b text-muted-foreground"><th class="py-2 pr-4">Tanggal</th><th class="py-2 pr-4">Rumah ID</th><th class="py-2 pr-4">Hasil jentik</th><th class="py-2">Catatan</th></tr></thead><tbody><tr v-for="item in recent" :key="item.id" class="border-b last:border-0"><td class="py-3 pr-4">{{ item.tanggal_pemeriksaan }}</td><td class="py-3 pr-4">{{ item.rumah_id }}</td><td class="py-3 pr-4"><span class="rounded-full px-2 py-1 text-xs" :class="item.hasil_jentik === 'positif' ? 'bg-rose-100 text-rose-800' : 'bg-emerald-100 text-emerald-800'">{{ item.hasil_jentik }}</span></td><td class="py-3">{{ item.catatan || '—' }}</td></tr></tbody></table></div>
            <p v-else class="mt-3 text-sm text-muted-foreground">Belum ada data pemeriksaan yang dapat ditampilkan.</p>
        </section>
    </main>
</template>
