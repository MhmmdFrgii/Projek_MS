<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $table = 'tb_organisasi';
    protected $primaryKey = 'id_organisasi';

    public $timestamps = false;

    protected $fillable = [
        'organisasi',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_organisasi', 'id_organisasi');
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('organisasi', 'LIKE', '%' . $search . '%');
        }

        return $query;
    }
}
