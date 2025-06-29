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
use Illuminate\Validation\ValidationException;

class DaftarController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                // 1.0 Enrollment Information
                'year_intake' => 'required|string',
                'enrollment_start' => 'required|string',
                'kelas' => 'required|string',
                'harga_kelas' => 'required|numeric|min:0',
                
                // 2.0 Student Details
                'student_name' => 'required|string|min:2',
                'mykid' => 'required|string|min:3',
                'darjah' => 'required|string',
                'religion' => 'required|string',
                'race' => 'required|string',
                'gender' => 'required|string',
                'birth_date' => 'required|date',
                
                // 3.0 Guardian Info
                'guardian_first_name' => 'required|string|min:2',
                'guardian_last_name' => 'required|string|min:2',
                'guardian_ic' => 'required|string|min:12',
                'guardian_email' => 'required|email',
                'password' => 'required|string|min:3',
                'password_confirmation' => 'required|same:password',
                'guardian_relation' => 'required|string',
                'guardian_mobile' => 'required|string|min:8',
                'guardian_home' => 'nullable|string',
                'guardian_address' => 'required|string|min:5',
                'guardian_occupation' => 'nullable|string',
                'guardian_salary' => 'required|string',
                
                // 6.0 How do you know about us
                'how_know' => 'required|string',
            ], [
                // Custom error messages dalam Bahasa Melayu
                'year_intake.required' => 'Tahun pengambilan diperlukan.',
                'enrollment_start.required' => 'Bulan mula diperlukan.',
                'kelas.required' => 'Sila pilih kelas.',
                'harga_kelas.required' => 'Harga kelas diperlukan.',
                'harga_kelas.numeric' => 'Harga kelas mestilah nombor.',
                'harga_kelas.min' => 'Harga kelas tidak sah.',
                
                'student_name.required' => 'Nama pelajar diperlukan.',
                'student_name.min' => 'Nama pelajar terlalu pendek.',
                'mykid.required' => 'Nombor MyKid diperlukan.',
                'mykid.min' => 'Nombor MyKid mestilah sekurang-kurangnya 12 digit.',
                'darjah.required' => 'Tahun diperlukan.',
                'religion.required' => 'Agama diperlukan.',
                'race.required' => 'Bangsa diperlukan.',
                'gender.required' => 'Jantina diperlukan.',
                'birth_date.required' => 'Tarikh lahir diperlukan.',
                'birth_date.date' => 'Format tarikh lahir tidak sah.',
                
                'guardian_first_name.required' => 'Nama pertama penjaga diperlukan.',
                'guardian_first_name.min' => 'Nama pertama penjaga terlalu pendek.',
                'guardian_last_name.required' => 'Nama akhir penjaga diperlukan.',
                'guardian_last_name.min' => 'Nama akhir penjaga terlalu pendek.',
                'guardian_ic.required' => 'Nombor IC penjaga diperlukan.',
                'guardian_ic.min' => 'Nombor IC penjaga mestilah sekurang-kurangnya 12 digit.',
                'guardian_email.required' => 'Alamat email diperlukan.',
                'guardian_email.email' => 'Format alamat email tidak sah.',
                'password.required' => 'Kata laluan diperlukan.',
                'password.min' => 'Kata laluan mestilah sekurang-kurangnya 6 aksara.',
                'password_confirmation.required' => 'Pengesahan kata laluan diperlukan.',
                'password_confirmation.same' => 'Kata laluan dan pengesahan kata laluan tidak sepadan.',
                'guardian_relation.required' => 'Hubungan dengan pelajar diperlukan.',
                'guardian_mobile.required' => 'Nombor telefon bimbit diperlukan.',
                'guardian_mobile.min' => 'Nombor telefon bimbit terlalu pendek.',
                'guardian_address.required' => 'Alamat rumah diperlukan.',
                'guardian_address.min' => 'Alamat rumah terlalu pendek.',
                'guardian_salary.required' => 'Gaji diperlukan.',
                
                'how_know.required' => 'Sila pilih bagaimana anda tahu tentang kami.',
            ]);

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

            // Validation tambahan sebelum hantar ke Toyyibpay
            $validationErrors = [];
            
            // Periksa email format
            if (!filter_var($request->guardian_email, FILTER_VALIDATE_EMAIL)) {
                $validationErrors[] = 'Alamat email tidak sah. Sila masukkan email yang betul (contoh: nama@email.com).';
            }
            
            // Periksa nombor telefon (mestilah nombor sahaja)
            if (!preg_match('/^[0-9+\-\s()]+$/', $request->guardian_mobile)) {
                $validationErrors[] = 'Nombor telefon tidak sah. Sila masukkan nombor telefon yang betul.';
            }
            
            // Periksa nama (tidak boleh kosong atau terlalu pendek)
            if (strlen(trim($request->guardian_first_name)) < 2) {
                $validationErrors[] = 'Nama pertama terlalu pendek. Sila masukkan nama yang betul.';
            }
            
            if (strlen(trim($request->guardian_last_name)) < 2) {
                $validationErrors[] = 'Nama akhir terlalu pendek. Sila masukkan nama yang betul.';
            }
            
            // Periksa harga kelas
            if (!is_numeric($request->harga_kelas) || $request->harga_kelas <= 0) {
                $validationErrors[] = 'Harga kelas tidak sah. Sila pilih kelas yang betul.';
            }
            
            // Periksa field lain yang diperlukan
            if (empty(trim($request->student_name))) {
                $validationErrors[] = 'Nama pelajar tidak boleh kosong.';
            }
            
            if (empty(trim($request->mykid))) {
                $validationErrors[] = 'Nombor MyKid tidak boleh kosong.';
            }
            
            if (empty(trim($request->guardian_ic))) {
                $validationErrors[] = 'Nombor IC penjaga tidak boleh kosong.';
            }
            
            if (empty(trim($request->guardian_address))) {
                $validationErrors[] = 'Alamat tidak boleh kosong.';
            }
            
            if (empty(trim($request->password))) {
                $validationErrors[] = 'Kata laluan tidak boleh kosong.';
            } elseif (strlen($request->password) < 6) {
                $validationErrors[] = 'Kata laluan mestilah sekurang-kurangnya 6 aksara.';
            }
            
            // Periksa password confirmation
            if (empty(trim($request->password_confirmation))) {
                $validationErrors[] = 'Pengesahan kata laluan tidak boleh kosong.';
            } elseif ($request->password !== $request->password_confirmation) {
                $validationErrors[] = 'Kata laluan dan pengesahan kata laluan tidak sepadan.';
            }
            
            // Periksa format nombor IC (12 digit)
            if (!preg_match('/^\d{12}$/', preg_replace('/[^0-9]/', '', $request->guardian_ic))) {
                $validationErrors[] = 'Nombor IC penjaga mestilah 12 digit nombor.';
            }
            
            // Periksa format MyKid (12 digit)
            if (!preg_match('/^\d{12}$/', preg_replace('/[^0-9]/', '', $request->mykid))) {
                $validationErrors[] = 'Nombor MyKid mestilah 12 digit nombor.';
            }
            
            // Jika ada validation errors, hapuskan daftar dan return error
            if (!empty($validationErrors)) {
                $daftar->delete();
                return redirect('/daftar')
                    ->with('error', implode(' ', $validationErrors))
                    ->withInput();
            }

            // Cipta bill Toyyibpay
            try {
                // Bersihkan data sebelum hantar ke Toyyibpay
                $cleanEmail = filter_var(trim($request->guardian_email), FILTER_SANITIZE_EMAIL);
                $cleanPhone = preg_replace('/[^0-9+\-\s()]/', '', $request->guardian_mobile);
                $cleanName = trim($request->guardian_first_name);
                $cleanAmount = (int)($request->harga_kelas * 100); // Convert to cents
                
                // Periksa data yang telah dibersihkan
                if (empty($cleanEmail) || !filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception('Alamat email tidak sah. Sila masukkan email yang betul (contoh: nama@email.com).');
                }
                
                if (empty($cleanPhone) || strlen($cleanPhone) < 8) {
                    throw new \Exception('Nombor telefon tidak sah. Sila masukkan nombor telefon yang betul.');
                }
                
                if (empty($cleanName) || strlen($cleanName) < 2) {
                    throw new \Exception('Nama tidak sah. Sila masukkan nama yang betul.');
                }
                
                if ($cleanAmount <= 0) {
                    throw new \Exception('Jumlah bayaran tidak sah. Sila pilih kelas yang betul.');
                }
                
                $bill = [
                    'userSecretKey' => '5u2u5cii-sor5-2w3r-ubu1-z4mspf0i8ekb',
                    'categoryCode' => '5i0gylh0',
                    'billName' => 'Pendaftaran Kelas',
                    'billDescription' => 'Bayaran kelas: ' . $request->kelas,
                    'billPriceSetting' => 1,
                    'billPayorInfo' => 1,
                    'billExternalReferenceNo' => 'AFR341DFI',
                    'billAmount' => $cleanAmount,
                    'billReturnUrl' => route('toyyibpay.callback', ['daftar_id' => $daftar->id]),
                    'billCallbackUrl' => route('toyyibpay.callback', ['daftar_id' => $daftar->id]),
                    'billTo' => $cleanName,
                    'billEmail' => $cleanEmail,
                    'billPhone' => $cleanPhone,
                    'billPaymentChannel' => '0',
                    'billSplitPayment' => '1',
                    'chargeFPXB2B' => '1',
                ];
                
                $bojek = (object) $bill;
                $data = ToyyibpayFacade::createBill('5i0gylh0', $bojek);
                
                // Periksa response dari Toyyibpay
                if (!$data || !is_array($data) || empty($data)) {
                    throw new \Exception('Sistem pembayaran tidak dapat dihubungi. Sila cuba lagi.');
                }
                
                // Periksa struktur data
                if (!isset($data[0]) || !is_object($data[0]) || !isset($data[0]->BillCode)) {
                    throw new \Exception('Sistem pembayaran mengembalikan data yang tidak sah. Sila cuba lagi.');
                }
                
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
                
            } catch (\Exception $toyyibpayError) {
                Log::error('Toyyibpay Error: ' . $toyyibpayError->getMessage());
                
                // Hapuskan daftar yang baru dicipta kerana pembayaran gagal
                if (isset($daftar)) {
                    $daftar->delete();
                }
                
                // Berikan mesej yang lebih spesifik berdasarkan error
                $errorMessage = $toyyibpayError->getMessage();
                
                // Jika error message sudah dalam Bahasa Melayu, gunakan terus
                if (strpos($errorMessage, 'Sila') !== false || strpos($errorMessage, 'tidak sah') !== false) {
                    // Error message sudah dalam format yang betul
                } else {
                    // Error message masih teknikal, tukar kepada mesej mesra pengguna
                    if (strpos($errorMessage, 'email') !== false || strpos($errorMessage, 'Email') !== false) {
                        $errorMessage = 'Alamat email tidak sah. Sila masukkan email yang betul (contoh: nama@email.com).';
                    } elseif (strpos($errorMessage, 'phone') !== false || strpos($errorMessage, 'Phone') !== false) {
                        $errorMessage = 'Nombor telefon tidak sah. Sila masukkan nombor telefon yang betul.';
                    } elseif (strpos($errorMessage, 'amount') !== false || strpos($errorMessage, 'Amount') !== false) {
                        $errorMessage = 'Jumlah bayaran tidak sah. Sila pilih kelas yang betul.';
                    } elseif (strpos($errorMessage, 'name') !== false || strpos($errorMessage, 'Name') !== false) {
                        $errorMessage = 'Nama tidak sah. Sila masukkan nama yang betul.';
                    } elseif (strpos($errorMessage, 'connection') !== false || strpos($errorMessage, 'timeout') !== false) {
                        $errorMessage = 'Sistem pembayaran tidak dapat dihubungi. Sila cuba lagi dalam beberapa minit.';
                    } else {
                        $errorMessage = 'Sistem pembayaran sedang mengalami masalah teknikal. Sila cuba lagi dalam beberapa minit atau hubungi kami untuk bantuan.';
                    }
                }
                
                return redirect('/daftar')
                    ->with('error', $errorMessage)
                    ->withInput();
            }

        } catch (ValidationException $e) {
            // Return dengan error validation yang mesra pengguna
            return redirect('/daftar')->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error dalam pendaftaran: ' . $e->getMessage());
            return redirect('/daftar')->with('error', 'Ralat dalam pendaftaran. Sila cuba lagi.');
        }
    }
}
