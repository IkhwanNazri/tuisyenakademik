<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tarsoft\Toyyibpay\ToyyibpayFacade;
use Toyyibpay;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/user'); // redirect ke panel user
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:3',
        ]);

        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        return redirect('/login')->with('success', 'Pendaftaran berjaya! Sila login.');
    }

    public function registerDaftar(Request $request)
    {
        $request->validate([
            // Contoh validasi minimum, boleh tambah ikut keperluan
            'student_name' => 'required',
            'guardian_email' => 'required|email|unique:users,email',
            'guardian_first_name' => 'required',
            'guardian_last_name' => 'required',
            'guardian_mobile' => 'required',
            'guardian_ic' => 'required',
            'birth_date' => 'required|date',
            'mykid' => 'required',
            'kelas' => 'required',
            'harga_kelas' => 'required',
       
            'password' => 'required|confirmed|min:3',
            // ... boleh tambah validasi lain jika perlu
        ]);

        // Simpan data pendaftaran (status pending, belum cipta user)
        $daftar = \App\Models\Daftar::create(array_merge(
            $request->except(['password', 'password_confirmation', 'harga_kelas']),
            [
                'kelas' => $request->kelas,
                'harga_kelas' => $request->harga_kelas,
                'status' => 'pending',
                'password' => $request->password, // TAMBAH INI
            ]
        ));

        // Cipta bill Toyyibpay
        $bill =  [
            'userSecretKey' => '5u2u5cii-sor5-2w3r-ubu1-z4mspf0i8ekb',
            'categoryCode' =>'5i0gylh0',
            'billName' => 'Pendaftaran Kelas',
            'billDescription' => 'Bayaran kelas: ' . $request->kelas,
            'billPriceSetting' => 1,
            'billPayorInfo'=>1,
            'billExternalReferenceNo' => 'AFR341DFI',
            'billAmount' => $request->harga_kelas * 100,
            'billReturnUrl' => route('toyyibpay.callback', ['daftar_id' => $daftar->id]),
            'billCallbackUrl' => route('toyyibpay.callback', ['daftar_id' => $daftar->id]),
            'billTo' => $request->guardian_first_name,
            'billEmail' => $request->guardian_email,
            'billPhone' => $request->guardian_mobile,
            'billPaymentChannel' => '0',
        
            'billSplitPayment' => '1',
            'chargeFPXB2B'=> '1',
        ];
        $bojek = (object) $bill;

        $data = ToyyibpayFacade::createBill('5i0gylh0', $bojek);
        //  dd($data,$bill);
            // dd($data[0]->BillCode);
        $bill_code = $data[0]->BillCode;
        
        // Cipta transaksi dengan status pending
        Transaction::create([
            'user_id' => null, // Akan diupdate selepas user dicipta
            'daftar_id' => $daftar->id,
            'kelas' => $request->kelas,
            'harga_kelas' => $request->harga_kelas,
            'jumlah' => $request->harga_kelas,
            'bill_code' => $bill_code,
            'status' => 'pending',
            'tarikh' => null, // Akan diupdate selepas pembayaran
        ]);

    // return redirect('billPaymentLink',$bill_code);

        // Redirect ke payment link
        return redirect(ToyyibpayFacade::billPaymentLink($bill_code));
    }
    public function getBankFPX()
    {
        $cuba = ToyyibpayFacade::getBanksFPX();
        // dd($cuba); 
    }

    public function toyyibpayCallback(Request $request)
    {
        Log::info('Callback Toyyibpay', $request->all());
        
        $daftar = \App\Models\Daftar::find($request->daftar_id);
        if (!$daftar) {
            Log::error('Daftar tidak dijumpai', ['daftar_id' => $request->daftar_id]);
            return redirect('/login')->with('error', 'Rekod pendaftaran tidak dijumpai.');
        }
        
        // Update status pendaftaran
        $daftar->status = 'berjaya';
        $daftar->save();

        // Cari user, cipta jika belum wujud
        $user = User::where('email', $daftar->guardian_email)->first();
        if (!$user) {
            $user = User::create([
                'name' => $daftar->guardian_first_name . ' ' . $daftar->guardian_last_name,
                'email' => $daftar->guardian_email,
                'password' => bcrypt($daftar->password),
                'role' => 'user',
            ]);
        }

        // Cari transaksi berdasarkan bill_code
        $transaction = Transaction::where('bill_code', $request->billcode)->first();
        if ($transaction) {
            $transaction->status = 'berjaya';
            $transaction->tarikh = Carbon::now();
            $transaction->user_id = $user->id; // Pastikan user_id betul
            $transaction->save();
            Log::info('Transaksi diupdate', ['transaction_id' => $transaction->id, 'status' => 'berjaya']);
        } else {
            // Jika tiada, cipta transaksi baru
            $transaction = Transaction::create([
                'user_id'   => $user->id,
                'daftar_id' => $daftar->id,
                'kelas'     => $daftar->kelas,
                'harga_kelas'    => $daftar->harga_kelas,
                'jumlah'    => $daftar->harga_kelas,
                'bill_code' => $request->get('billcode') ?? '',
                'status'    => 'berjaya',
                'tarikh'    => Carbon::now(),
            ]);
            Log::info('Transaksi baru dicipta', ['transaction_id' => $transaction->id]);
        }

        return redirect('/login')->with('success', 'Pendaftaran & pembayaran berjaya! Sila login.');
    }
    public function billPaymentLink($bill_code)
    {
        // dd($bill_code);
        $data =ToyyibpayFacade::billPaymentLink($bill_code);
        Log::info('Redirecting to Toyyibpay:', ['url' => $data]);
        return redirect($data);
    }
}
