<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class imageSP extends Model
{
    use HasFactory;
    protected $table = 'imagesp';
    protected $guarded = [];
    // public $timestamps = false;
    protected $primaryKey = 'maISP';


    public function SanPham():BelongsTo{
        return $this->belongsTo(SanPham::class, 'idsp');

    }
}