<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelajar;
use App\Models\Daftar;

class DaftarController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'darjah' => 'required|string|max:100',
        ]);

        // Simpan ke table daftars
        $daftar = Daftar::create([
            'student_name' => $request->nama,
            'kelas' => $request->kelas,
            'darjah' => $request->darjah,
        ]);

        // Simpan ke table pelajars untuk admin panel dengan daftar_id
        $pelajar = Pelajar::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'darjah' => $request->darjah,
            'daftar_id' => $daftar->id,
        ]);

        return redirect('/daftar')->with('success', 'Pendaftaran pelajar berjaya!');
    }
}
