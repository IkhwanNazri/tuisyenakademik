<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Daftar extends Model
{
    protected $fillable = [
        // 1.0 Enrollment Information
         'year_intake', 'enrollment_start',
        // 2.0 Student Details
        'student_name', 'mykid', 'religion', 'race', 'gender', 'birth_date','kelas','jumlah','harga_kelas','darjah',
        // 3.0 Guardian Info
        'guardian_first_name', 'guardian_last_name', 'guardian_ic', 'guardian_email', 'guardian_relation', 'guardian_mobile', 'guardian_home', 'guardian_address', 'guardian_occupation', 'guardian_salary',
        // 4.0 Spouse Info
        'password',
        // 6.0 How do you know about us
        'how_know',
    ];

    public function pelajar(): HasOne
    {
        return $this->hasOne(Pelajar::class, 'daftar_id');
    }
}
