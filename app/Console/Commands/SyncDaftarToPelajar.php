<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Daftar;
use App\Models\Pelajar;

class SyncDaftarToPelajar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:daftar-to-pelajar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync data dari table daftars ke table pelajars';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mula sync data dari daftars ke pelajars...');

        $daftars = Daftar::all();
        $count = 0;

        foreach ($daftars as $daftar) {
            // Check if pelajar already exists for this daftar
            $existingPelajar = Pelajar::where('daftar_id', $daftar->id)->first();
            
            if (!$existingPelajar) {
                // Create new pelajar record
                Pelajar::create([
                    'nama' => $daftar->student_name,
                    'kelas' => $daftar->kelas,
                    'darjah' => $daftar->darjah,
                    'daftar_id' => $daftar->id,
                ]);
                $count++;
                $this->info("Dicipta: {$daftar->student_name} - {$daftar->kelas} - {$daftar->darjah}");
            } else {
                // Update existing pelajar record
                $existingPelajar->update([
                    'nama' => $daftar->student_name,
                    'kelas' => $daftar->kelas,
                    'darjah' => $daftar->darjah,
                ]);
                $this->info("Diupdate: {$daftar->student_name} - {$daftar->kelas} - {$daftar->darjah}");
            }
        }

        $this->info("Sync selesai! {$count} rekod baru dicipta.");
    }
}
