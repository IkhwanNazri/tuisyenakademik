<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelajar;
use App\Models\Daftar;
use App\Models\User;
use App\Models\Transaction;
use Tarsoft\Toyyibpay\ToyyibpayFacade;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DaftarController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            // 1.0 Enrollment Information
            'year_intake' => 'required|string',
            'enrollment_start' => 'required|string',
            'kelas' => 'required|string',
            'harga_kelas' => 'required|numeric',
            
            // 2.0 Student Details
            'student_name' => 'required|string|max:255',
            'mykid' => 'required|string|max:255',
            'darjah' => 'required|string',
            'religion' => 'required|string',
            'race' => 'required|string',
            'gender' => 'required|string',
            'birth_date' => 'required|date',
            
            // 3.0 Guardian Info
            'guardian_first_name' => 'required|string|max:255',
            'guardian_last_name' => 'required|string|max:255',
            'guardian_ic' => 'required|string|max:255',
            'guardian_email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:3',
            'guardian_relation' => 'required|string',
            'guardian_mobile' => 'required|string',
            'guardian_home' => 'nullable|string',
            'guardian_address' => 'required|string',
            'guardian_occupation' => 'nullable|string',
            'guardian_salary' => 'required|string',
            
            // 6.0 How do you know about us
            'how_know' => 'required|string',
        ]);

        try {
            // Simpan ke table daftars
            $daftar = Daftar::create([
                // 1.0 Enrollment Information
                'year_intake' => $request->year_intake,
                'enrollment_start' => $request->enrollment_start,
                'kelas' => $request->kelas,
                'harga_kelas' => $request->harga_kelas,
                
                // 2.0 Student Details
                'student_name' => $request->student_name,
                'mykid' => $request->mykid,
                'darjah' => $request->darjah,
                'religion' => $request->religion,
                'race' => $request->race,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                
                // 3.0 Guardian Info
                'guardian_first_name' => $request->guardian_first_name,
                'guardian_last_name' => $request->guardian_last_name,
                'guardian_ic' => $request->guardian_ic,
                'guardian_email' => $request->guardian_email,
                'password' => $request->password,
                'guardian_relation' => $request->guardian_relation,
                'guardian_mobile' => $request->guardian_mobile,
                'guardian_home' => $request->guardian_home,
                'guardian_address' => $request->guardian_address,
                'guardian_occupation' => $request->guardian_occupation,
                'guardian_salary' => $request->guardian_salary,
                
                // 6.0 How do you know about us
                'how_know' => $request->how_know,
                'status' => 'pending',
            ]);

            // Cipta bill Toyyibpay
            $bill = [
                'userSecretKey' => '5u2u5cii-sor5-2w3r-ubu1-z4mspf0i8ekb',
                'categoryCode' => '5i0gylh0',
                'billName' => 'Pendaftaran Kelas',
                'billDescription' => 'Bayaran kelas: ' . $request->kelas,
                'billPriceSetting' => 1,
                'billPayorInfo' => 1,
                'billExternalReferenceNo' => 'AFR341DFI',
                'billAmount' => $request->harga_kelas * 100,
                'billReturnUrl' => route('toyyibpay.callback', ['daftar_id' => $daftar->id]),
                'billCallbackUrl' => route('toyyibpay.callback', ['daftar_id' => $daftar->id]),
                'billTo' => $request->guardian_first_name,
                'billEmail' => $request->guardian_email,
                'billPhone' => $request->guardian_mobile,
                'billPaymentChannel' => '0',
                'billSplitPayment' => '1',
                'chargeFPXB2B' => '1',
            ];
            
            $bojek = (object) $bill;
            $data = ToyyibpayFacade::createBill('5i0gylh0', $bojek);
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

            // Redirect ke payment link
            return redirect(ToyyibpayFacade::billPaymentLink($bill_code));

        } catch (\Exception $e) {
            Log::error('Error dalam pendaftaran: ' . $e->getMessage());
            return redirect('/daftar')->with('error', 'Ralat dalam pendaftaran. Sila cuba lagi.');
        }
    }
}
