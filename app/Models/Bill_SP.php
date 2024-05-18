<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class bill_sp extends Model
{
    use HasFactory;
    protected $table = 'bill_sp';
    protected $guarded = [];
    // public $timestamps = false;
    protected $primaryKey = 'maBillSP';


    public function SanPham():BelongsTo{
        return $this->belongsTo(SanPham::class, 'idsp');

    }

    public function Bill():BelongsTo{
        return $this->belongsTo(Bill::class, 'idbill');

    }

}