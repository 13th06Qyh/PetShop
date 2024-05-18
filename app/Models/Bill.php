<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class bill extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'bill';
    // public $timestamps = false;
    protected $primaryKey = 'maBill';


    public function User():BelongsTo{
        return $this->belongsTo(User::class, 'iduser');

    }
    
    public function Bill_SP():HasMany{
        return $this->hasMany(Bill_SP::class, 'maBill');

    }
}