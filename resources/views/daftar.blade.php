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
                    <select name="year_intake" class="w-full border rounded px-3 py-2" required>
                        <option value="">Pilih Tahun</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Enrollment Start *</label>
                    <select name="enrollment_start" class="w-full border rounded px-3 py-2" required>
                        <option value="">Pilih Bulan</option>
                        <option value="JANUARI">JANUARI</option>
                        <option value="FEBRUARI">FEBRUARI</option>
                        <option value="MAC">MAC</option>
                        <option value="APRIL">APRIL</option>
                        <option value="MEI">MEI</option>
                        <option value="JUN">JUN</option>
                        <option value="JULAI">JULAI</option>
                        <option value="OGOS">OGOS</option>
                        <option value="SEPTEMBER">SEPTEMBER</option>
                        <option value="OKTOBER">OKTOBER</option>
                        <option value="NOVEMBER">NOVEMBER</option>
                        <option value="DISEMBER">DISEMBER</option>
                    </select>
                </div>
                
            </div>
            <script>
                const hargaKelas = {
                    'Kelas Membaca': 150,
                    'Tahun 3 & 4': 180,
                    'Tahun 5 & 6': 220,
                    'Tingkatan 1 , 2 & 3': 150,
                    'Tingkatan 4 & 5': 200,
                };
                function updateHarga() {
                    let kelas = '';
                    const radios = document.getElementsByClassName('kelas-radio');
                    for (let i = 0; i < radios.length; i++) {
                        if (radios[i].checked) {
                            kelas = radios[i].value;
                            // Highlight product card
                            radios[i].parentElement.classList.add('border-blue-600', 'ring-4', 'ring-blue-200', 'selected');
                        } else {
                            radios[i].parentElement.classList.remove('border-blue-600', 'ring-4', 'ring-blue-200', 'selected');
                        }
                    }
                    const harga = hargaKelas[kelas] || '';
                    let hargaPaparan = '';
                    if (harga !== '') {
                        hargaPaparan = 'RM ' + Number(harga).toLocaleString('ms-MY', {minimumFractionDigits:2, maximumFractionDigits:2});
                    }
                    document.getElementById('harga_kelas_display').value = hargaPaparan;
                    document.getElementById('harga_kelas').value = harga;
                }
            </script>
            <!-- 2.0 Student Details -->
            <div class="mt-6 border-t pt-6">
                <h2 class="text-xl font-bold mb-2">Maklumat Pelajar</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Nama *</label>
                        <input type="text" name="student_name" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">MyKID *</label>
                        <input type="text" name="mykid" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Tahun *</label>
                       <select name="darjah" id="darjah" class="w-full border rounded px-3 py-2" required>
                        <option value="">Pilih Tahun</option>
                        <option value="Tahun 1">Tahun 1</option>
                        <option value="Tahun 2">Tahun 2</option>
                        <option value="Tahun 3">Tahun 3</option>
                        <option value="Tahun 4">Tahun 4</option>
                        <option value="Tahun 5">Tahun 5</option>
                        <option value="Tahun 6">Tahun 6</option>
                        <option value="Tingkatan 1">Tingkatan 1</option>
                        <option value="Tingkatan 2">Tingkatan 2</option>
                        <option value="Tingkatan 3">Tingkatan 3</option>
                        <option value="Tingkatan 4">Tingkatan 4</option>
                        <option value="Tingkatan 5">Tingkatan 5</option>
                        <option value="Lain">Lain-lain</option>
                        
                       </select>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Agama *</label>
                        <select name="religion" class="w-full border rounded px-3 py-2" required>
                            <option value="">Pilih</option>
                            <option value="Islam">Islam</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Christian">Christian</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Bangsa *</label>
                        <select name="race" class="w-full border rounded px-3 py-2" required>
                            <option value="">Pilih</option>
                            <option value="Malay">Malay</option>
                            <option value="Chinese">Chinese</option>
                            <option value="Indian">Indian</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Jantina *</label>
                        <select name="gender" class="w-full border rounded px-3 py-2" required>
                            <option value="">Pilih</option>
                            <option value="Male">Lelaki</option>
                            <option value="Female">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Tarikh Lahir *</label>
                        <input type="date" name="birth_date" class="w-full border rounded px-3 py-2" required>
                    </div>
                 
                </div>
            </div>
            <!-- 3.0 Guardian Info -->
            <div class="mt-6 border-t pt-6">
                <h2 class="text-xl font-bold mb-2">Maklumat Penjaga</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Nama Pertama *</label>
                        <input type="text" name="guardian_first_name" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Nama Akhir *</label>
                        <input type="text" name="guardian_last_name" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">No. IC *</label>
                        <input type="text" name="guardian_ic" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Email *</label>
                        <input type="email" name="guardian_email" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Password *</label>
                        <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Pengesahan Password *</label>
                        <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Hubungan *</label>
                        <select name="guardian_relation" class="w-full border rounded px-3 py-2" required>
                            <option value="">Pilih</option>
                            <option value="Father">Bapa</option>
                            <option value="Mother">Ibu</option>
                            <option value="Uncle">Pakcik</option>
                            <option value="Aunty">Makcik</option>
                            <option value="Grandfather">Datuk</option>
                            <option value="Grandmother">Nenek</option>
                            <option value="Brother">Abang</option>
                            <option value="Sister">Kakak</option>
                            <option value="Other">Lain-lain</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">No. Telefon Bimbit *</label>
                        <input type="text" name="guardian_mobile" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">No. Telefon Rumah</label>
                        <input type="text" name="guardian_home" class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block font-semibold mb-1">Alamat Rumah *</label>
                        <input type="text" name="guardian_address" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Pekerjaan</label>
                        <input type="text" name="guardian_occupation" class="w-full border rounded px-3 py-2">
                    </div>
                   
                    <div>
                        <label class="block font-semibold mb-1">Gaji *</label>
                        <select name="guardian_salary" class="w-full border rounded px-3 py-2" required>
                            <option value="">Pilih</option>
                            <option value="<2000">Kurang RM2000</option>
                            <option value="2000-3000">RM2000 - RM3000</option>
                            <option value="3000-4000">RM3000 - RM4000</option>
                            <option value="4000-5000">RM4000 - RM5000</option>
                            <option value=">5000">RM5000 ke atas</option>
                        </select>
                    </div>
                    
                </div>
            </div>
           
            <!-- 6.0 How do you know about us -->
            <div class="mt-6 border-t pt-6">
                <h2 class="text-xl font-bold mb-2">Bagaimana Anda Tahu Tentang Kami?</h2>
                <select name="how_know" class="w-full border rounded px-3 py-2" required>
                    <option value="">Pilih</option>
                    <option value="Facebook">Facebook</option>
                    <option value="Instagram">Instagram</option>
                    <option value="Referred Family/Friends">Referred Family/Friends</option>
                    <option value="Radio">Radio</option>
                    <option value="Television">Television</option>
                    <option value="Street banner">Street banner</option>
                    <option value="Google">Google</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="mt-8 text-center">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition">Hantar Permohonan</button>
            </div>
        </form>
    </div>
</body>
</html> 