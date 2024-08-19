<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruJurusan extends Model
{
    use HasFactory;

    protected $filllable = [
        'guru_id',
        'jurusan_id'
    ];
}
