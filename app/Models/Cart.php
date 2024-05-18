<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $guarded = [];
    // public $timestamps = false;
    protected $primaryKey = 'maCart';


    public function User():BelongsTo{
        return $this->belongsTo(User::class, 'iduser');

    }

    public function SanPham():HasMany{
        return $this->hasMany(SanPham::class, 'idsp');

    }
}