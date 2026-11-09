<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class PemeriksaanController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();
        $role = $user->role ?? '';
        abort_unless(in_array($role, ['petugas', 'ketua_jumantik', 'koordinator'], true), 403);

        $query = DB::connection('supabase')->table('pemeriksaan')->orderByDesc('tanggal_pemeriksaan');
        if ($role === 'petugas') {
            $query->where('petugas_id', $user->getAuthIdentifier());
        } elseif ($role === 'ketua_jumantik') {
            $rwId = $user->rw_id;
            $query->whereIn('rumah_id', function ($q) use ($rwId) {
                $q->select('rumah.id')->from('rumah')
                    ->join('wilayah', 'wilayah.id', '=', 'rumah.wilayah_id')
                    ->where('wilayah.rw_id', $rwId);
            });
        }

        return Inertia::render('Pemeriksaan/Index', ['items' => $query->limit(200)->get()]);
    }

    public function create(Request $request): Response
    {
        abort_unless(($request->user()->role ?? null) === 'petugas', 403);
        $wilayahId = $request->user()->wilayah_id;
        $houses = DB::connection('supabase')->table('rumah')
            ->where('status_aktif', true)
            ->when($wilayahId, fn ($q) => $q->where('wilayah_id', $wilayahId))
            ->orderBy('kode_rumah')->get(['id', 'kode_rumah', 'alamat']);

        return Inertia::render('Pemeriksaan/Create', ['houses' => $houses]);
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(($request->user()->role ?? null) === 'petugas', 403);
        $validated = $request->validate([
            'rumah_id' => ['required', 'integer'],
            'tanggal_pemeriksaan' => ['required', 'date'],
            'hasil_jentik' => ['required', 'in:positif,negatif'],
            'catatan' => ['nullable', 'string', 'max:2000'],
        ]);

        $db = DB::connection('supabase');
        $house = $db->table('rumah')->where('id', $validated['rumah_id'])->first();
        abort_unless($house && (string) $house->wilayah_id === (string) $request->user()->wilayah_id, 403);

        $db->table('pemeriksaan')->insert([
            'rumah_id' => $house->id,
            'petugas_id' => $request->user()->getAuthIdentifier(),
            'tanggal_pemeriksaan' => $validated['tanggal_pemeriksaan'],
            'hasil_jentik' => $validated['hasil_jentik'],
            'catatan' => $validated['catatan'] ?? null,
            'created_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Hasil pemeriksaan berhasil disimpan.');
    }
}
