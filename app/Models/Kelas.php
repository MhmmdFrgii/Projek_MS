<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'tb_kelas';
    protected $primaryKey = 'id_kelas';

    public $timestamps = true;

    protected $fillable = ['kelas'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id_kelas');
    }

    public function guru()
    {
        return $this->hasMany(Guru::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('kelas', 'LIKE', '%' . $search . '%');
        }

        return $query;
    }
}

