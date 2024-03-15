<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jadwal extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function mapel() : BelongsTo {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id');
    }
    public function kelas() : BelongsTo {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }
}
