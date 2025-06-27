<?php

namespace App\Providers\Filament;

use App\Models\Daftar;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Tarsoft\Toyyibpay\Toyyibpay as ToyyibpayToyyibpay;
use Tarsoft\Toyyibpay\ToyyibpayFacade;
use Toyyibpay;
use Illuminate\Http\Request;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('user')
            ->path('user')
            ->brandName('Akademik Terbilang')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/User/Resources'), for: 'App\\Filament\\User\\Resources')
            ->discoverPages(in: app_path('Filament/User/Pages'), for: 'App\\Filament\\User\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/User/Widgets'), for: 'App\\Filament\\User\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    public function registerDaftar(Request $request)
    {
        // 1. Validasi & simpan data pendaftaran (tanpa cipta user dahulu)
        // 2. Kira jumlah harga kelas
        $kelasDipilih = $request->kelas; // array kelas
        $kelasHarga = [
            'Tahun 1 - Membaca' => 150,
            'Tahun 5 - Bahasa Inggeris' => 200,
            // ... dan seterusnya
        ];
        $total = 0;
        foreach ($kelasDipilih as $k) {
            $total += $kelasHarga[$k];
        }

        // 3. Simpan data pendaftaran (status: pending)
        $daftar = Daftar::create([
            // ... semua field lain
            'kelas' => json_encode($kelasDipilih),
            'jumlah_bayaran' => $total,
            'status' => 'pending',
        ]);

        // 4. Cipta bill Toyyibpay
        $bill =  [
            'userSecretKey' => '5u2u5cii-sor5-2w3r-ubu1-z4mspf0i8ekb',
            'categoryCode' =>'5i0gylh0',
            'billName' => 'Pendaftaran Kelas',
            'billDescription' => 'Bayaran kelas: ' . implode(', ', $kelasDipilih),
            'billPriceSetting'=>1,
            'billPayorInfo'=>1,
            'billAmount' => $total,
            'billReturnUrl' => route('toyyibpay.callback', ['daftar_id' => $daftar->id]),
            'billCallbackUrl' => route('toyyibpay.callback', ['daftar_id' => $daftar->id]),
            'billTo' => $request->guardian_first_name,
            'billEmail' => $request->guardian_email,
            'billPhone' => $request->guardian_mobile,
            // ... parameter lain Toyyibpay
        ];

        // 5. Redirect ke payment link
        return redirect(ToyyibpayFacade::billPaymentLink($bill));
    }
}
