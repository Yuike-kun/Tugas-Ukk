<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function siswa() : HasMany {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id');
    }

    public function jadwal() : HasMany {
        return $this->hasMany(Jadwal::class, 'id_kelas', 'id');
    }
}
