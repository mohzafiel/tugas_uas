<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hutang extends Model
{
    use HasFactory;

    protected $table = 'hutang';

    protected $fillable = ['nama_lengkap', 'tanggal', 'nominal', 'status'];
}