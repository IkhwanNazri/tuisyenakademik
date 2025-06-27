<div class="p-4">
    <h2 class="text-xl font-bold mb-4">Maklumat Pendaftaran</h2>
    <table class="w-full text-sm">
        <tr><td class="font-semibold pr-2">Nama Pelajar</td><td>: {{ $record->student_name }}</td></tr>
        <tr><td class="font-semibold pr-2">MyKID</td><td>: {{ $record->mykid }}</td></tr>
        <tr><td class="font-semibold pr-2">Tarikh Lahir</td><td>: {{ $record->birth_date }}</td></tr>
        <tr><td class="font-semibold pr-2">Kelas</td><td>: {{ $record->darjah }}</td></tr>
        <tr><td class="font-semibold pr-2">Penjaga</td><td>: {{ $record->guardian_first_name }} {{ $record->guardian_last_name }}</td></tr>
        <tr><td class="font-semibold pr-2">Email Penjaga</td><td>: {{ $record->guardian_email }}</td></tr>
        <tr><td class="font-semibold pr-2">No. Telefon Penjaga</td><td>: {{ $record->guardian_mobile }}</td></tr>
        <tr><td class="font-semibold pr-2">Hubungan Penjaga</td><td>: {{ $record->guardian_relation }}</td></tr>
        <tr><td class="font-semibold pr-2">Gaji Penjaga</td><td>: {{ $record->guardian_salary }}</td></tr>
     
        <tr><td class="font-semibold pr-2">Year Intake</td><td>: {{ $record->year_intake }}</td></tr>
        <tr><td class="font-semibold pr-2">Enrollment Start</td><td>: {{ $record->enrollment_start }}</td></tr>
        <tr><td class="font-semibold pr-2">Agama</td><td>: {{ $record->religion }}</td></tr>
        <tr><td class="font-semibold pr-2">Bangsa</td><td>: {{ $record->race }}</td></tr>
        <tr><td class="font-semibold pr-2">Jantina</td><td>: {{ $record->gender }}</td></tr>
      
        <!-- Tambah field lain jika mahu -->
    </table>
</div> 