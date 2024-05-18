<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class type extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'type';
    // public $timestamps = false;
    protected $primaryKey = 'maType';


    public function SanPham():HasMany{
        return $this->hasMany(SanPham::class, 'maType');

    }
}