<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class animal extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'animal';
    // public $timestamps = false;
    protected $primaryKey = 'maAnimal';


    public function SanPham():HasMany{
        return $this->hasMany(SanPham::class, 'maAnimal');

    }

    public function Blog():HasMany{
        return $this->hasMany(Blog::class, 'maAnimal');

    }
}