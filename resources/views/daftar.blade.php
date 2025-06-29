<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borang Daftar Pelajar</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a62dd69ab2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-pink-100 min-h-screen py-8 font-['Nunito']">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-2xl border border-blue-200">
        <h1 class="text-3xl font-extrabold text-sky-600 mb-3 text-center ">Borang Daftar Pelajar</h1>
        <p class="text-md text-violet-800 font-medium drop-shadow-md text-center">Pilih tahun dan isi maklumat untuk mendaftar</p>
        
        @if(session('error'))
            <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-200">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif
        
        @if(session('success'))
            <div class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-200">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif
        
        @if($errors->any())
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-200">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/daftar" method="POST" class="space-y-6">
            @csrf
            <!-- 1.0 Enrollment Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block font-bold drop-shadow-xs text-shadow mb-1">Pilih Kelas *</label>
                    <div id="kelas-card-group" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-8 items-stretch text-center">
                        @php
                            $kelasList = [
                                [
                                    'label' => 'Kelas Membaca',
                                    'color' => 'bg-white',
                                    'harga' => 150,
                                    'desc' => ['✓ <strong class="text-gray-600 font-extrabold text-xl">RM20</strong>/ Pendaftaran',
                                          '✓ <strong class="text-gray-600 font-extrabold text-xl">2jam</strong>/ Seminggu',
                                           '✓ <strong class="text-gray-600 font-extrabold text-xl">RM60</strong>/ Buku & Modul',
                                            '✓ <strong class="text-gray-600 font-extrabold text-xl">RM70</strong>/ 2 Bulan MP ']
                                ],
                                [
                                    'label' => 'Tahun 3 & 4',
                                    'color' => 'bg-white',
                                    'harga' => 180,
                                    'desc' => [ 
                                        '✓ <strong class="text-gray-600 font-extrabold text-xl">RM20</strong>/ Pendaftaran',
                                          '✓ <strong class="text-gray-600 font-extrabold text-xl">4jam</strong>/ Seminggu',
                                           '✓ <strong class="text-gray-600 font-extrabold text-xl">RM60</strong>/ Buku & Modul',
                                            '✓ <strong class="text-gray-600 font-extrabold text-xl">RM100</strong>/ 2 Bulan MP ']
                                ],
                                [
                                    'label' => 'Tahun 5 & 6',
                                    'color' => 'bg-white',
                                    'harga' => 220,
                                    'desc' => ['✓ <strong class="text-gray-600 font-extrabold text-xl">RM20</strong>/ Pendaftaran',
                                          '✓ <strong class="text-gray-600 font-extrabold text-xl">4jam</strong>/ Seminggu',
                                           '✓ <strong class="text-gray-600 font-extrabold text-xl">RM80</strong>/ Buku & Modul',
                                            '✓ <strong class="text-gray-600 font-extrabold text-xl">RM120</strong>/ 2 Bulan MP ']
                                ],
                                [
                                    'label' => 'Tingkatan 1 , 2 & 3',
                                    'color' => 'bg-white',
                                    'harga' => 150,
                                    'desc' => ['✓ <strong class="text-gray-600 font-extrabold text-xl">RM20</strong>/ Pendaftaran',
                                          '✓ <strong class="text-gray-600 font-extrabold text-xl">4jam</strong>/ Seminggu',
                                           '✓ <strong class="text-gray-600 font-extrabold text-xl">RM50</strong>/ Buku & Modul',
                                            '✓ <strong class="text-gray-600 font-extrabold text-xl">RM80</strong>/ 2 Bulan MP ']
                                ],
                                [
                                    'label' => 'Tingkatan 4 & 5',
                                    'color' => 'bg-white',
                                    'harga' => 200,
                                    'desc' => ['✓ <strong class="text-gray-600 font-extrabold text-xl">RM20</strong>/ Pendaftaran',
                                          '✓ <strong class="text-gray-600 font-extrabold text-xl">4jam</strong>/ Seminggu',
                                           '✓ <strong class="text-gray-600 font-extrabold text-xl">RM80</strong>/ Buku & Modul',
                                            '✓ <strong class="text-gray-600 font-extrabold text-xl">RM100</strong>/ 2 Bulan MP ']
                                ],
                                
                            ];
                        @endphp
                        @foreach($kelasList as $kelas)
                            <label class="cursor-pointer group block   rounded-2xl overflow-hidden shadow-xl bg-gradient-to-br {{ $kelas['color'] }} transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 hover:scale-105 relative product-card h-full min-h-[370px]">
                                <input type="radio" name="kelas" value="{{ $kelas['label'] }}" class="hidden kelas-radio" required onchange="updateHarga()">
                                <span>
                                    
                                </span>
                                <div class="flex flex-col h-full flex-1 ">
                                    <div class="bg-gradient-to-r from-white/80 to-white/60 p-6  rounded-t-xl flex-1  ">
                                       
                                        <h3 class="text-2xl font-extrabold text-gray-500  mb-1 ">
                                        
                                            <span class="font-['Nunito'] block w-full  rounded-t-xl px-4 py-2 text-sky-700 font-extrabold shadow-none -mt-6">
                                                {{ $kelas['label'] }}
                                            </span>
                                        </h3>
                                        <ul class="text-gray-700 space-y-2 mb-4 text-base font-medium font-['Nunito']">
                                            @foreach($kelas['desc'] as $item)
                                                <li class="flex items-center">
                                                    @if(Str::startsWith($item, '✓'))
                                                        <span class="mr-2 text-lg text-green-600"><i class="fa-solid fa-circle-check"></i></span>
                                                        <span>{!! trim(Str::replaceFirst('✓', '', $item)) !!}</span>
                                                    @else
                                                        <span class="mr-2 text-lg">{!! $item !!}</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="p-6 bg-sky-200 flex flex-col items-center">
                                        <div class="font-['Nunito'] text-3xl font-extrabold text-blue-700 mb-2">RM {{ number_format($kelas['harga'], 2) }}</div>
                                        <div class="selected-indicator hidden group-[.selected]:inline-block bg-gradient-to-r from-green-400 to-emerald-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                            ✓ Dipilih
                                        </div>
                                    </div>
                                </div>
                                <span class="absolute top-3 right-3 hidden group-[.selected]:inline-block bg-blue-600 text-white rounded-full px-3 py-1 text-xs font-bold shadow">Dipilih</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1">Harga Kelas</label>
                    <input type="text" id="harga_kelas_display" class="w-full border rounded px-3 py-2 bg-gray-100" readonly>
                    <input type="hidden" name="harga_kelas" id="harga_kelas">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Year Intake *</label>
                    <select name="year_intake" class="w-full border rounded px-3 py-2 {{ $errors->has('year_intake') ? 'border-red-500' : '' }}" required>
                        <option value="">Pilih Tahun</option>
                        <option value="2025" {{ old('year_intake') == '2025' ? 'selected' : '' }}>2025</option>
                        <option value="2026" {{ old('year_intake') == '2026' ? 'selected' : '' }}>2026</option>
                    </select>
                    @if($errors->has('year_intake'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('year_intake') }}</p>
                    @endif
                </div>
                <div>
                    <label class="block font-semibold mb-1">Enrollment Start *</label>
                    <select name="enrollment_start" class="w-full border rounded px-3 py-2 {{ $errors->has('enrollment_start') ? 'border-red-500' : '' }}" required>
                        <option value="">Pilih Bulan</option>
                        <option value="JANUARI" {{ old('enrollment_start') == 'JANUARI' ? 'selected' : '' }}>JANUARI</option>
                        <option value="FEBRUARI" {{ old('enrollment_start') == 'FEBRUARI' ? 'selected' : '' }}>FEBRUARI</option>
                        <option value="MAC" {{ old('enrollment_start') == 'MAC' ? 'selected' : '' }}>MAC</option>
                        <option value="APRIL" {{ old('enrollment_start') == 'APRIL' ? 'selected' : '' }}>APRIL</option>
                        <option value="MEI" {{ old('enrollment_start') == 'MEI' ? 'selected' : '' }}>MEI</option>
                        <option value="JUN" {{ old('enrollment_start') == 'JUN' ? 'selected' : '' }}>JUN</option>
                        <option value="JULAI" {{ old('enrollment_start') == 'JULAI' ? 'selected' : '' }}>JULAI</option>
                        <option value="OGOS" {{ old('enrollment_start') == 'OGOS' ? 'selected' : '' }}>OGOS</option>
                        <option value="SEPTEMBER" {{ old('enrollment_start') == 'SEPTEMBER' ? 'selected' : '' }}>SEPTEMBER</option>
                        <option value="OKTOBER" {{ old('enrollment_start') == 'OKTOBER' ? 'selected' : '' }}>OKTOBER</option>
                        <option value="NOVEMBER" {{ old('enrollment_start') == 'NOVEMBER' ? 'selected' : '' }}>NOVEMBER</option>
                        <option value="DISEMBER" {{ old('enrollment_start') == 'DISEMBER' ? 'selected' : '' }}>DISEMBER</option>
                    </select>
                    @if($errors->has('enrollment_start'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('enrollment_start') }}</p>
                    @endif
                </div>
                
            </div>
            <script>
                console.log('JavaScript dimuat!');
                
                const hargaKelas = {
                    'Kelas Membaca': 150,
                    'Tahun 3 & 4': 180,
                    'Tahun 5 & 6': 220,
                    'Tingkatan 1 , 2 & 3': 150,
                    'Tingkatan 4 & 5': 200,
                };
                
                // Debug: Log semua key yang ada
                console.log('Semua key dalam hargaKelas:', Object.keys(hargaKelas));
                
                function updateHarga() {
                    console.log('updateHarga() dipanggil!');
                    let kelas = '';
                    const radios = document.getElementsByClassName('kelas-radio');
                    console.log('Jumlah radio button:', radios.length);
                    
                    for (let i = 0; i < radios.length; i++) {
                        console.log('Radio', i, 'value:', radios[i].value, 'checked:', radios[i].checked);
                        if (radios[i].checked) {
                            kelas = radios[i].value;
                            console.log('Kelas dipilih:', kelas);
                            console.log('Panjang string kelas:', kelas.length);
                            console.log('Kelas dalam quotes:', '"' + kelas + '"');
                            
                            // Test untuk setiap key
                            Object.keys(hargaKelas).forEach(key => {
                                console.log('Membandingkan dengan key:', '"' + key + '"', 'Panjang:', key.length);
                                console.log('Sama?', kelas === key);
                                console.log('Sama (trim)?', kelas.trim() === key.trim());
                            });
                            
                            // Highlight product card
                            radios[i].parentElement.classList.add('border-blue-600', 'ring-4', 'ring-blue-200', 'selected');
                        } else {
                            radios[i].parentElement.classList.remove('border-blue-600', 'ring-4', 'ring-blue-200', 'selected');
                        }
                    }
                    
                    console.log('Kelas akhir:', kelas);
                    console.log('Kelas dalam hargaKelas:', kelas in hargaKelas);
                    
                    // Penyelesaian yang lebih robust
                    let harga = 0;
                    const kelasTrim = kelas.trim();
                    
                    // Cuba cari dengan exact match
                    if (hargaKelas[kelas]) {
                        harga = hargaKelas[kelas];
                        console.log('Dijumpai dengan exact match');
                    }
                    // Cuba cari dengan trim
                    else if (hargaKelas[kelasTrim]) {
                        harga = hargaKelas[kelasTrim];
                        console.log('Dijumpai dengan trim');
                    }
                    // Cuba cari dengan partial match
                    else {
                        const keys = Object.keys(hargaKelas);
                        for (let key of keys) {
                            if (kelas.includes(key) || key.includes(kelas)) {
                                harga = hargaKelas[key];
                                console.log('Dijumpai dengan partial match:', key);
                                break;
                            }
                        }
                    }
                    
                    console.log('Harga untuk kelas', kelas, ':', harga);
                    
                    let hargaPaparan = '';
                    if (harga !== 0) {
                        hargaPaparan = 'RM ' + Number(harga).toLocaleString('ms-MY', {minimumFractionDigits:2, maximumFractionDigits:2});
                    }
                    document.getElementById('harga_kelas_display').value = hargaPaparan;
                    document.getElementById('harga_kelas').value = harga;
                    console.log('Harga paparan:', hargaPaparan);
                }
                
                // Tambah event listener apabila DOM siap
                document.addEventListener('DOMContentLoaded', function() {
                    console.log('DOM siap!');
                    
                    // Tambah event listener untuk semua radio button
                    const radios = document.getElementsByClassName('kelas-radio');
                    console.log('Menambah event listener untuk', radios.length, 'radio button');
                    
                    for (let i = 0; i < radios.length; i++) {
                        radios[i].addEventListener('change', function() {
                            console.log('Radio button', i, 'berubah!');
                            updateHarga();
                        });
                    }
                });
            </script>
            <!-- 2.0 Student Details -->
            <div class="mt-6 border-t pt-6">
                <h2 class="text-xl font-bold mb-2">Maklumat Pelajar</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Nama *</label>
                        <input type="text" name="student_name" value="{{ old('student_name') }}" class="w-full border rounded px-3 py-2 {{ $errors->has('student_name') ? 'border-red-500' : '' }}" required>
                        @if($errors->has('student_name'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('student_name') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">MyKID *</label>
                        <input type="text" name="mykid" value="{{ old('mykid') }}" class="w-full border rounded px-3 py-2 {{ $errors->has('mykid') ? 'border-red-500' : '' }}" required>
                        @if($errors->has('mykid'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('mykid') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Tahun *</label>
                       <select name="darjah" id="darjah" class="w-full border rounded px-3 py-2 {{ $errors->has('darjah') ? 'border-red-500' : '' }}" required>
                        <option value="">Pilih Tahun</option>
                        <option value="Tahun 1" {{ old('darjah') == 'Tahun 1' ? 'selected' : '' }}>Tahun 1</option>
                        <option value="Tahun 2" {{ old('darjah') == 'Tahun 2' ? 'selected' : '' }}>Tahun 2</option>
                        <option value="Tahun 3" {{ old('darjah') == 'Tahun 3' ? 'selected' : '' }}>Tahun 3</option>
                        <option value="Tahun 4" {{ old('darjah') == 'Tahun 4' ? 'selected' : '' }}>Tahun 4</option>
                        <option value="Tahun 5" {{ old('darjah') == 'Tahun 5' ? 'selected' : '' }}>Tahun 5</option>
                        <option value="Tahun 6" {{ old('darjah') == 'Tahun 6' ? 'selected' : '' }}>Tahun 6</option>
                        <option value="Tingkatan 1" {{ old('darjah') == 'Tingkatan 1' ? 'selected' : '' }}>Tingkatan 1</option>
                        <option value="Tingkatan 2" {{ old('darjah') == 'Tingkatan 2' ? 'selected' : '' }}>Tingkatan 2</option>
                        <option value="Tingkatan 3" {{ old('darjah') == 'Tingkatan 3' ? 'selected' : '' }}>Tingkatan 3</option>
                        <option value="Tingkatan 4" {{ old('darjah') == 'Tingkatan 4' ? 'selected' : '' }}>Tingkatan 4</option>
                        <option value="Tingkatan 5" {{ old('darjah') == 'Tingkatan 5' ? 'selected' : '' }}>Tingkatan 5</option>
                        <option value="Lain" {{ old('darjah') == 'Lain' ? 'selected' : '' }}>Lain-lain</option>
                        
                       </select>
                       @if($errors->has('darjah'))
                           <p class="text-red-500 text-sm mt-1">{{ $errors->first('darjah') }}</p>
                       @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Agama *</label>
                        <select name="religion" class="w-full border rounded px-3 py-2 {{ $errors->has('religion') ? 'border-red-500' : '' }}" required>
                            <option value="">Pilih</option>
                            <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Buddha" {{ old('religion') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Christian" {{ old('religion') == 'Christian' ? 'selected' : '' }}>Christian</option>
                            <option value="Other" {{ old('religion') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @if($errors->has('religion'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('religion') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Bangsa *</label>
                        <select name="race" class="w-full border rounded px-3 py-2 {{ $errors->has('race') ? 'border-red-500' : '' }}" required>
                            <option value="">Pilih</option>
                            <option value="Malay" {{ old('race') == 'Malay' ? 'selected' : '' }}>Malay</option>
                            <option value="Chinese" {{ old('race') == 'Chinese' ? 'selected' : '' }}>Chinese</option>
                            <option value="Indian" {{ old('race') == 'Indian' ? 'selected' : '' }}>Indian</option>
                            <option value="Other" {{ old('race') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @if($errors->has('race'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('race') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Jantina *</label>
                        <select name="gender" class="w-full border rounded px-3 py-2 {{ $errors->has('gender') ? 'border-red-500' : '' }}" required>
                            <option value="">Pilih</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Lelaki</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @if($errors->has('gender'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('gender') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Tarikh Lahir *</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="w-full border rounded px-3 py-2 {{ $errors->has('birth_date') ? 'border-red-500' : '' }}" required>
                        @if($errors->has('birth_date'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('birth_date') }}</p>
                        @endif
                    </div>
                 
                </div>
            </div>
            <!-- 3.0 Guardian Info -->
            <div class="mt-6 border-t pt-6">
                <h2 class="text-xl font-bold mb-2">Maklumat Penjaga</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Nama Pertama *</label>
                        <input type="text" name="guardian_first_name" value="{{ old('guardian_first_name') }}" class="w-full border rounded px-3 py-2 {{ $errors->has('guardian_first_name') ? 'border-red-500' : '' }}" required>
                        @if($errors->has('guardian_first_name'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('guardian_first_name') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Nama Akhir *</label>
                        <input type="text" name="guardian_last_name" value="{{ old('guardian_last_name') }}" class="w-full border rounded px-3 py-2 {{ $errors->has('guardian_last_name') ? 'border-red-500' : '' }}" required>
                        @if($errors->has('guardian_last_name'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('guardian_last_name') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">No. IC *</label>
                        <input type="text" name="guardian_ic" value="{{ old('guardian_ic') }}" class="w-full border rounded px-3 py-2 {{ $errors->has('guardian_ic') ? 'border-red-500' : '' }}" required>
                        @if($errors->has('guardian_ic'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('guardian_ic') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Email *</label>
                        <input type="email" name="guardian_email" value="{{ old('guardian_email') }}" class="w-full border rounded px-3 py-2 {{ $errors->has('guardian_email') ? 'border-red-500' : '' }}" required>
                        @if($errors->has('guardian_email'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('guardian_email') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Password *</label>
                        <input type="password" name="password" class="w-full border rounded px-3 py-2 {{ $errors->has('password') ? 'border-red-500' : '' }}" required>
                        @if($errors->has('password'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Pengesahan Password *</label>
                        <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2 {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}" required>
                        @if($errors->has('password_confirmation'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('password_confirmation') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Hubungan *</label>
                        <select name="guardian_relation" class="w-full border rounded px-3 py-2 {{ $errors->has('guardian_relation') ? 'border-red-500' : '' }}" required>
                            <option value="">Pilih</option>
                            <option value="Father" {{ old('guardian_relation') == 'Father' ? 'selected' : '' }}>Bapa</option>
                            <option value="Mother" {{ old('guardian_relation') == 'Mother' ? 'selected' : '' }}>Ibu</option>
                            <option value="Uncle" {{ old('guardian_relation') == 'Uncle' ? 'selected' : '' }}>Pakcik</option>
                            <option value="Aunty" {{ old('guardian_relation') == 'Aunty' ? 'selected' : '' }}>Makcik</option>
                            <option value="Grandfather" {{ old('guardian_relation') == 'Grandfather' ? 'selected' : '' }}>Datuk</option>
                            <option value="Grandmother" {{ old('guardian_relation') == 'Grandmother' ? 'selected' : '' }}>Nenek</option>
                            <option value="Brother" {{ old('guardian_relation') == 'Brother' ? 'selected' : '' }}>Abang</option>
                            <option value="Sister" {{ old('guardian_relation') == 'Sister' ? 'selected' : '' }}>Kakak</option>
                            <option value="Other" {{ old('guardian_relation') == 'Other' ? 'selected' : '' }}>Lain-lain</option>
                        </select>
                        @if($errors->has('guardian_relation'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('guardian_relation') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">No. Telefon Bimbit *</label>
                        <input type="text" name="guardian_mobile" value="{{ old('guardian_mobile') }}" class="w-full border rounded px-3 py-2 {{ $errors->has('guardian_mobile') ? 'border-red-500' : '' }}" required>
                        @if($errors->has('guardian_mobile'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('guardian_mobile') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">No. Telefon Rumah</label>
                        <input type="text" name="guardian_home" value="{{ old('guardian_home') }}" class="w-full border rounded px-3 py-2 {{ $errors->has('guardian_home') ? 'border-red-500' : '' }}">
                        @if($errors->has('guardian_home'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('guardian_home') }}</p>
                        @endif
                    </div>
                    <div class="md:col-span-2">
                        <label class="block font-semibold mb-1">Alamat Rumah *</label>
                        <input type="text" name="guardian_address" value="{{ old('guardian_address') }}" class="w-full border rounded px-3 py-2 {{ $errors->has('guardian_address') ? 'border-red-500' : '' }}" required>
                        @if($errors->has('guardian_address'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('guardian_address') }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Pekerjaan</label>
                        <input type="text" name="guardian_occupation" value="{{ old('guardian_occupation') }}" class="w-full border rounded px-3 py-2 {{ $errors->has('guardian_occupation') ? 'border-red-500' : '' }}">
                        @if($errors->has('guardian_occupation'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('guardian_occupation') }}</p>
                        @endif
                    </div>
                   
                    <div>
                        <label class="block font-semibold mb-1">Gaji *</label>
                        <select name="guardian_salary" class="w-full border rounded px-3 py-2 {{ $errors->has('guardian_salary') ? 'border-red-500' : '' }}" required>
                            <option value="">Pilih</option>
                            <option value="<2000" {{ old('guardian_salary') == '<2000' ? 'selected' : '' }}>Kurang RM2000</option>
                            <option value="2000-3000" {{ old('guardian_salary') == '2000-3000' ? 'selected' : '' }}>RM2000 - RM3000</option>
                            <option value="3000-4000" {{ old('guardian_salary') == '3000-4000' ? 'selected' : '' }}>RM3000 - RM4000</option>
                            <option value="4000-5000" {{ old('guardian_salary') == '4000-5000' ? 'selected' : '' }}>RM4000 - RM5000</option>
                            <option value=">5000" {{ old('guardian_salary') == '>5000' ? 'selected' : '' }}>RM5000 ke atas</option>
                        </select>
                        @if($errors->has('guardian_salary'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('guardian_salary') }}</p>
                        @endif
                    </div>
                    
                </div>
            </div>
           
            <!-- 6.0 How do you know about us -->
            <div class="mt-6 border-t pt-6">
                <h2 class="text-xl font-bold mb-2">Bagaimana Anda Tahu Tentang Kami?</h2>
                <select name="how_know" class="w-full border rounded px-3 py-2 {{ $errors->has('how_know') ? 'border-red-500' : '' }}" required>
                    <option value="">Pilih</option>
                    <option value="Facebook" {{ old('how_know') == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                    <option value="Instagram" {{ old('how_know') == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                    <option value="Referred Family/Friends" {{ old('how_know') == 'Referred Family/Friends' ? 'selected' : '' }}>Referred Family/Friends</option>
                    <option value="Radio" {{ old('how_know') == 'Radio' ? 'selected' : '' }}>Radio</option>
                    <option value="Television" {{ old('how_know') == 'Television' ? 'selected' : '' }}>Television</option>
                    <option value="Street banner" {{ old('how_know') == 'Street banner' ? 'selected' : '' }}>Street banner</option>
                    <option value="Google" {{ old('how_know') == 'Google' ? 'selected' : '' }}>Google</option>
                    <option value="Others" {{ old('how_know') == 'Others' ? 'selected' : '' }}>Others</option>
                </select>
                @if($errors->has('how_know'))
                    <p class="text-red-500 text-sm mt-1">{{ $errors->first('how_know') }}</p>
                @endif
            </div>
            <div class="mt-8 text-center">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition">Hantar Permohonan</button>
            </div>
        </form>
    </div>
</body>
</html> 