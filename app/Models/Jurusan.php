<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'tb_jurusan';
    protected $primaryKey = 'id_jurusan';

    public $timestamps = false;

    protected $fillable = [
        'jurusan',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function guru()
    {
        return $this->hasMany(Guru::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('jurusan', 'LIKE', '%' . $search . '%');
        }

        return $query;
    }
}
