<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mapel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function guru() : BelongsTo {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }

    public function jadwal() : HasMany {
        return $this->hasMany(Jadwal::class, 'id_mapel', 'id');
    }
}
