<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { login } from '@/routes';
</script>

<template>
    <Head title="Jumantik Care">
        <meta
            name="description"
            content="Sistem Informasi Pemeriksaan dan Pelaporan Jumantik Kelurahan Kali Anyar"
        />
    </Head>

    <div class="min-h-screen bg-slate-50 text-slate-800">
        <!-- Navbar -->
        <header class="border-b border-slate-200 bg-white">
            <div
                class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-8"
            >
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-600 text-xl text-white"
                    >
                        🦟
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900">
                            Jumantik Care
                        </h1>
                        <p class="text-xs text-slate-500">
                            Kelurahan Kali Anyar
                        </p>
                    </div>
                </div>

                <Link
                    :href="login()"
                    class="rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700"
                >
                    Masuk ke Sistem
                </Link>
            </div>
        </header>

        <!-- Hero -->
        <main>
            <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8 lg:py-28">
                <div class="grid items-center gap-14 lg:grid-cols-2">
                    <div>
                        <span
                            class="inline-flex rounded-full bg-emerald-100 px-4 py-2 text-sm font-medium text-emerald-700"
                        >
                            Sistem Informasi Jumantik
                        </span>

                        <h2
                            class="mt-6 text-4xl font-extrabold leading-tight tracking-tight text-slate-900 sm:text-5xl"
                        >
                            Bersama Wujudkan Lingkungan
                            <span class="text-emerald-600">
                                Bebas Jentik
                            </span>
                        </h2>

                        <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">
                            Platform digital untuk membantu petugas Jumantik
                            melakukan pemeriksaan, pencatatan, dan pelaporan
                            jentik nyamuk secara lebih mudah, terstruktur, dan
                            terintegrasi.
                        </p>

                        <div class="mt-9 flex flex-wrap gap-4">
                            <Link
                                :href="login()"
                                class="rounded-lg bg-emerald-600 px-7 py-3.5 font-semibold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700"
                            >
                                Mulai Sekarang →
                            </Link>

                            <a
                                href="#fitur"
                                class="rounded-lg border border-slate-300 bg-white px-7 py-3.5 font-semibold text-slate-700 transition hover:bg-slate-100"
                            >
                                Pelajari Fitur
                            </a>
                        </div>
                    </div>

                    <!-- Illustration -->
                    <div
                        class="relative flex min-h-[320px] items-center justify-center overflow-hidden rounded-3xl bg-emerald-600 p-10"
                    >
                        <div
                            class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-emerald-500"
                        ></div>
                        <div
                            class="absolute -bottom-20 -left-16 h-64 w-64 rounded-full bg-emerald-700"
                        ></div>

                        <div
                            class="relative z-10 w-full max-w-sm rounded-2xl bg-white p-8 shadow-2xl"
                        >
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-slate-500">
                                        Jumantik Care
                                    </p>
                                    <h3 class="mt-1 text-xl font-bold">
                                        Pemeriksaan Jentik
                                    </h3>
                                </div>
                                <span class="text-4xl">🏡</span>
                            </div>

                            <div class="mt-8 space-y-4">
                                <div
                                    class="flex items-center gap-4 rounded-xl bg-emerald-50 p-4"
                                >
                                    <span class="text-2xl">📋</span>
                                    <div>
                                        <p class="font-semibold text-slate-800">
                                            Pencatatan Pemeriksaan
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            Data pemeriksaan rumah
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center gap-4 rounded-xl bg-blue-50 p-4"
                                >
                                    <span class="text-2xl">📊</span>
                                    <div>
                                        <p class="font-semibold text-slate-800">
                                            Rekapitulasi Laporan
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            Laporan lebih terstruktur
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center gap-4 rounded-xl bg-amber-50 p-4"
                                >
                                    <span class="text-2xl">🔍</span>
                                    <div>
                                        <p class="font-semibold text-slate-800">
                                            Pemantauan Jentik
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            Mendukung pencegahan DBD
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features -->
            <section id="fitur" class="border-y border-slate-200 bg-white">
                <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center">
                        <span
                            class="text-sm font-bold uppercase tracking-wider text-emerald-600"
                        >
                            Fitur Utama
                        </span>
                        <h2 class="mt-3 text-3xl font-bold text-slate-900">
                            Pengelolaan Jumantik Lebih Terorganisir
                        </h2>
                        <p class="mt-4 leading-7 text-slate-600">
                            Mendukung proses pemeriksaan dan pelaporan melalui
                            satu sistem informasi berbasis web.
                        </p>
                    </div>

                    <div class="mt-14 grid gap-7 md:grid-cols-3">
                        <div
                            class="rounded-2xl border border-slate-200 p-7 transition hover:-translate-y-1 hover:shadow-lg"
                        >
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-2xl"
                            >
                                🏠
                            </div>
                            <h3 class="mt-5 text-lg font-bold">
                                Pemeriksaan Rumah
                            </h3>
                            <p class="mt-3 text-sm leading-6 text-slate-600">
                                Pencatatan hasil pemeriksaan rumah, termasuk
                                kondisi jentik positif maupun negatif.
                            </p>
                        </div>

                        <div
                            class="rounded-2xl border border-slate-200 p-7 transition hover:-translate-y-1 hover:shadow-lg"
                        >
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-2xl"
                            >
                                📑
                            </div>
                            <h3 class="mt-5 text-lg font-bold">
                                Rekapitulasi Laporan
                            </h3>
                            <p class="mt-3 text-sm leading-6 text-slate-600">
                                Membantu pengelolaan dan pengumpulan laporan
                                pemeriksaan secara digital.
                            </p>
                        </div>

                        <div
                            class="rounded-2xl border border-slate-200 p-7 transition hover:-translate-y-1 hover:shadow-lg"
                        >
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100 text-2xl"
                            >
                                📈
                            </div>
                            <h3 class="mt-5 text-lg font-bold">
                                Monitoring Data
                            </h3>
                            <p class="mt-3 text-sm leading-6 text-slate-600">
                                Memudahkan pemantauan hasil pemeriksaan dan
                                informasi laporan Jumantik.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Workflow -->
            <section class="mx-auto max-w-7xl px-6 py-20 lg:px-8">
                <div class="text-center">
                    <span
                        class="text-sm font-bold uppercase tracking-wider text-emerald-600"
                    >
                        Alur Sistem
                    </span>
                    <h2 class="mt-3 text-3xl font-bold text-slate-900">
                        Pelaporan dalam Satu Alur
                    </h2>
                </div>

                <div class="mt-12 grid gap-5 md:grid-cols-3">
                    <div class="rounded-2xl bg-white p-7 text-center shadow-sm">
                        <div class="text-4xl">👨‍🔬</div>
                        <h3 class="mt-4 font-bold">Petugas Jumantik</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            Melakukan pemeriksaan rumah dan mencatat hasil
                            pemeriksaan.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white p-7 text-center shadow-sm">
                        <div class="text-4xl">📋</div>
                        <h3 class="mt-4 font-bold">Ketua Jumantik</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            Mengelola dan merekap laporan pemeriksaan dari
                            petugas.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white p-7 text-center shadow-sm">
                        <div class="text-4xl">🏥</div>
                        <h3 class="mt-4 font-bold">Koordinator</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            Mengelola rekapitulasi dan meneruskan laporan
                            kepada pihak Puskesmas.
                        </p>
                    </div>
                </div>
            </section>

            <!-- CTA -->
            <section class="bg-emerald-700">
                <div
                    class="mx-auto max-w-5xl px-6 py-16 text-center text-white"
                >
                    <h2 class="text-3xl font-bold">
                        Mulai Kelola Pemeriksaan Jumantik
                    </h2>
                    <p class="mx-auto mt-4 max-w-2xl leading-7 text-emerald-100">
                        Gunakan Jumantik Care untuk mendukung proses
                        pemeriksaan dan pelaporan yang lebih terstruktur.
                    </p>
                    <Link
                        :href="login()"
                        class="mt-8 inline-flex rounded-lg bg-white px-7 py-3.5 font-semibold text-emerald-700 transition hover:bg-emerald-50"
                    >
                        Masuk ke Sistem →
                    </Link>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-slate-900 px-6 py-8 text-center text-sm text-slate-400">
            <p class="font-semibold text-white">Jumantik Care</p>
            <p class="mt-2">
                Sistem Informasi Pemeriksaan dan Pelaporan Jumantik
            </p>
            <p class="mt-1">
                Kelurahan Kali Anyar © 2026
            </p>
        </footer>
    </div>
</template>
