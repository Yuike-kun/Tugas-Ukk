<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function mapel() : HasMany {
        return $this->hasMany(Mapel::class, 'id_guru', 'id');
    }
}
