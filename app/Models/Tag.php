<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class tag extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tag';
    // public $timestamps = false;
    protected $primaryKey = 'maTag';


    public function SanPham():HasMany{
        return $this->hasMany(SanPham::class, 'maTag');

    }
}