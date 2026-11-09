<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
const props = defineProps<{ houses: Array<{ id: number; kode_rumah: string; alamat: string }> }>();
const form = useForm({ rumah_id: '', tanggal_pemeriksaan: new Date().toISOString().slice(0, 10), hasil_jentik: 'negatif', catatan: '' });
function submit() { form.post('/pemeriksaan'); }
</script>
<template>
    <Head title="Input Pemeriksaan" />
    <main class="mx-auto max-w-2xl space-y-6 p-4 md:p-6">
        <div><p class="text-sm font-medium text-emerald-700">Petugas Jumantik</p><h1 class="mt-1 text-2xl font-bold">Input Hasil Pemeriksaan</h1><p class="mt-1 text-sm text-muted-foreground">Catat hasil pemeriksaan rumah yang menjadi wilayah tugas Anda.</p></div>
        <form class="space-y-5 rounded-xl border bg-card p-5" @submit.prevent="submit">
            <div class="space-y-2"><label class="text-sm font-medium" for="rumah">Rumah yang diperiksa</label><select id="rumah" v-model="form.rumah_id" required class="w-full rounded-lg border bg-background px-3 py-2.5"><option value="" disabled>Pilih rumah</option><option v-for="house in houses" :key="house.id" :value="String(house.id)">{{ house.kode_rumah }} — {{ house.alamat }}</option></select><p v-if="form.errors.rumah_id" class="text-sm text-red-600">{{ form.errors.rumah_id }}</p><p v-if="!houses.length" class="text-sm text-amber-700">Belum ada rumah aktif di wilayah akun ini. Hubungi Koordinator untuk melengkapi data rumah.</p></div>
            <div class="space-y-2"><label class="text-sm font-medium" for="tanggal">Tanggal pemeriksaan</label><input id="tanggal" v-model="form.tanggal_pemeriksaan" type="date" required class="w-full rounded-lg border bg-background px-3 py-2.5" /></div>
            <fieldset class="space-y-2"><legend class="text-sm font-medium">Hasil pemeriksaan jentik</legend><div class="flex flex-wrap gap-4"><label class="flex items-center gap-2"><input v-model="form.hasil_jentik" type="radio" value="negatif" /> Tidak ditemukan jentik</label><label class="flex items-center gap-2"><input v-model="form.hasil_jentik" type="radio" value="positif" /> Ditemukan jentik</label></div></fieldset>
            <div class="space-y-2"><label class="text-sm font-medium" for="catatan">Catatan (opsional)</label><textarea id="catatan" v-model="form.catatan" rows="4" maxlength="2000" class="w-full rounded-lg border bg-background px-3 py-2.5" placeholder="Catatan kondisi tempat penampungan air atau temuan lainnya..."></textarea></div>
            <div class="flex justify-end"><button :disabled="form.processing || !houses.length" class="rounded-lg bg-emerald-700 px-5 py-2.5 text-sm font-semibold text-white disabled:opacity-50">{{ form.processing ? 'Menyimpan...' : 'Simpan pemeriksaan' }}</button></div>
        </form>
    </main>
</template>
