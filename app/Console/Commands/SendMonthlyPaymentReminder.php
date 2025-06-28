<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentReminder;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Tarsoft\Toyyibpay\ToyyibpayFacade;
use Barryvdh\DomPDF\Facade\Pdf;

class SendMonthlyPaymentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //  protected $signature = 'send:monthly-payment-reminder';
    // protected $signature = 'send:monthly-payment-reminder {email?}';
    protected $signature = 'send:monthly-payment-reminder {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hantar email peringatan pembayaran bulanan kepada semua user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $users = \App\Models\User::where('role', 'user')->get();
        // $users = \App\Models\User::where('email', 'aku@gmail.com')->get();
        $users = \App\Models\User::where('email', 'try@gmail.com')->get();
        foreach ($users as $user) {
            // Dapatkan daftar berdasarkan email penjaga
            $daftar = \App\Models\Daftar::where('guardian_email', $user->email)->first();
            if (!$daftar) {
                Log::warning('Tiada daftar untuk user: ' . $user->email);
                continue;
            }
            $harga = (float) ($daftar->harga_kelas ?? 0);

            // Cipta bill Toyyibpay
            $bill =  [
                'userSecretKey' => '5u2u5cii-sor5-2w3r-ubu1-z4mspf0i8ekb',
                'categoryCode' =>'5i0gylh0',
                'billName' => 'Yuran Bulanan',
                'billDescription' => 'Bayaran kelas: ' . $daftar->kelas,
                'billPriceSetting' => 1,
                'billPayorInfo'=>1,
                'billExternalReferenceNo' => 'BILL-' . $user->id . '-' . now()->format('Ym'),
                'billAmount' => ((float) $daftar->harga_kelas) * 100,
                'billReturnUrl' => route('toyyibpay.callback', ['daftar_id' => $daftar->id]),
                'billCallbackUrl' => route('toyyibpay.callback', ['daftar_id' => $daftar->id]),
                'billTo' => $daftar->guardian_first_name,
                'billEmail' => $user->email,
                'billPhone' => $daftar->guardian_mobile,
                'billPaymentChannel' => '0',
                'billSplitPayment' => '1',
                'chargeFPXB2B'=> '1',
            ];
            $bojek = (object) $bill;
            $data = ToyyibpayFacade::createBill('5i0gylh0', $bojek);
            Log::info('Toyyibpay response:', ['data' => $data]);

            $bill_code = null;
            if (is_array($data) && isset($data[0]) && isset($data[0]->BillCode)) {
                $bill_code = $data[0]->BillCode;
            } elseif (is_object($data) && isset($data->BillCode)) {
                $bill_code = $data->BillCode;
            }
            if (!$bill_code) {
                Log::error('Gagal cipta bill untuk user: ' . $user->email);
                continue;
            }
            
        //     $bojek = (object) $bill;

        // $data = ToyyibpayFacade::createBill('5i0gylh0', $bojek);
        // //  dd($data,$bill);
        //     // dd($data[0]->BillCode);
        // $bill_code = $data[0]->BillCode;



            // Cipta transaksi baru
            \App\Models\Transaction::create([
                'user_id' => $user->id,
                'daftar_id' => $daftar->id,
                'kelas' => $daftar->kelas,
                'harga_kelas' => $harga,
                'jumlah' => $harga,
                'bill_code' => $bill_code,
                'status' => 'pending',
                'tarikh' => now(),
            ]);

            // Hantar email peringatan
            Mail::to($user->email)->send(new \App\Mail\PaymentReminder($user));
        }
        $this->info('Monthly payment reminders sent!');
    }
}
