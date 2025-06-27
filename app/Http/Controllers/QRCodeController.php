<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Pelajar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function showQrCode(Pelajar $pelajar)
    {
        return view('pelajar.show-qr', compact('pelajar'));
    }

    public function scanQrPage()
    {
        return view('pelajar.scan-qr');
    }
    public function getPelajarData(Request $request)
    {
        $pelajarId = $request->input('id');
        
        if (!$pelajarId) {
            return response()->json(['error' => 'ID pelajar tidak ditemukan'], 404);
        }
        
        $pelajar = Pelajar::find($pelajarId);
        
        if (!$pelajar) {
            return response()->json(['error' => 'Pelajar tidak ditemukan'], 404);
        }
        
        // Rekod kehadiran
        $kehadiran = new Kehadiran();
        $kehadiran->pelajar_id = $pelajar->id;
        $kehadiran->tarikh = Carbon::now()->toDateString();
        $kehadiran->masa = Carbon::now()->toTimeString();
        $kehadiran->save();
        
        return response()->json([
            'id' => $pelajar->id,
            'nama' => $pelajar->nama,
            'kelas' => $pelajar->kelas,
            'darjah'=> $pelajar->darjah,
            'tarikh' => $kehadiran->tarikh,
            'masa' => $kehadiran->masa
        ]);
    }
}
