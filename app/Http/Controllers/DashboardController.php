<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use Throwable;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        $user = request()->user();
        $role = (string) ($user->role ?? 'petugas');
        abort_unless(in_array($role, ['petugas', 'ketua_jumantik', 'koordinator'], true), 403);

        $stats = [
            'rumah' => 0, 'pemeriksaan' => 0, 'jentik_positif' => 0,
            'tindak_lanjut_belum' => 0, 'petugas' => 0, 'wilayah_rw' => 0,
        ];
        $recent = [];
        $connected = false;
        $error = null;

        try {
            $db = DB::connection('supabase');
            $houses = $db->table('rumah');
            $checks = $db->table('pemeriksaan');
            $profiles = $db->table('profiles');
            $followUps = $db->table('tindak_lanjut');

            if ($role === 'petugas') {
                $checks->where('petugas_id', $user->getAuthIdentifier());
                $houses->where('wilayah_id', $user->wilayah_id)->where('status_aktif', true);
                $stats['rumah'] = (clone $houses)->count();
                $stats['pemeriksaan'] = (clone $checks)->count();
                $stats['jentik_positif'] = (clone $checks)->where('hasil_jentik', 'positif')->count();
                $recent = (clone $checks)->orderByDesc('tanggal_pemeriksaan')->limit(8)->get()->all();
            } elseif ($role === 'ketua_jumantik') {
                $rwId = $user->rw_id;
                $wilayahIds = $db->table('wilayah')->where('rw_id', $rwId)->pluck('id');
                $houses->whereIn('wilayah_id', $wilayahIds);
                $checks->whereIn('rumah_id', function ($q) use ($wilayahIds) {
                    $q->select('id')->from('rumah')->whereIn('wilayah_id', $wilayahIds);
                });
                $stats['rumah'] = (clone $houses)->count();
                $stats['pemeriksaan'] = (clone $checks)->count();
                $stats['jentik_positif'] = (clone $checks)->where('hasil_jentik', 'positif')->count();
                $stats['petugas'] = $profiles->where('role', 'petugas')->where('rw_id', $rwId)->count();
                $recent = (clone $checks)->orderByDesc('tanggal_pemeriksaan')->limit(8)->get()->all();
            } else {
                $stats['rumah'] = $houses->count();
                $stats['pemeriksaan'] = $checks->count();
                $stats['jentik_positif'] = (clone $checks)->where('hasil_jentik', 'positif')->count();
                $stats['petugas'] = $profiles->where('role', 'petugas')->count();
                $stats['wilayah_rw'] = $db->table('wilayah_rw')->count();
                $recent = $checks->orderByDesc('tanggal_pemeriksaan')->limit(8)->get()->all();
            }

            $followQuery = $followUps->where('status', 'belum_ditangani');
            if ($role === 'petugas') {
                $followQuery->whereIn('pemeriksaan_id', function ($q) use ($user) {
                    $q->select('id')->from('pemeriksaan')->where('petugas_id', $user->getAuthIdentifier());
                });
            } elseif ($role === 'ketua_jumantik') {
                $rwId = $user->rw_id;
                $followQuery->whereIn('pemeriksaan_id', function ($q) use ($rwId) {
                    $q->select('pemeriksaan.id')->from('pemeriksaan')
                        ->join('rumah', 'rumah.id', '=', 'pemeriksaan.rumah_id')
                        ->join('wilayah', 'wilayah.id', '=', 'rumah.wilayah_id')
                        ->where('wilayah.rw_id', $rwId);
                });
            }
            $stats['tindak_lanjut_belum'] = $followQuery->count();
            $connected = true;
        } catch (Throwable $exception) {
            report($exception);
            $error = 'Data Supabase belum dapat dimuat. Periksa konfigurasi koneksi database dan hak akses.';
        }

        return Inertia::render('Dashboard', [
            'stats' => $stats,
            'role' => $role,
            'roleLabel' => match ($role) {
                'koordinator' => 'Koordinator Jumantik',
                'ketua_jumantik' => 'Ketua Jumantik',
                default => 'Petugas Jumantik',
            },
            'supabaseConnected' => $connected,
            'connectionMessage' => $error,
            'recent' => $recent,
        ]);
    }
}
