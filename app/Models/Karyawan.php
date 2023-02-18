<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $karyawanID = 'KaryawanID';
    protected $fillable = [
        'KaryawanName',
        'KaryawanAge',
        'KaryawanAddress',
        'KaryawanPhoneNo'
    ];
}
