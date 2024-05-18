<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class sanpham extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    protected $guarded = [];
    
    protected $primaryKey = 'maSP';
    
    

    

    // public function Provide():BelongsTo{
    //     return $this->belongsTo(Provide::class, 'maSP');
    // }

    public function Animal():BelongsTo{
        return $this->belongsTo(Animal::class, 'idanimal');

    }

    public function Type():BelongsTo{
        return $this->belongsTo(Type::class, 'idtype');

    }
 
    public function Tag():BelongsTo{
        return $this->belongsTo(Tag::class, 'idtag');

    }

    public function ImageSP():HasMany{
        return $this->hasMany(ImageSP::class, 'idsp', 'maSP');

    }

    public function Bill_SP():HasMany{
        return $this->hasMany(Bill_SP::class, 'maSP');

    }

    public function Cart():BelongsTo{
        return $this->belongsTo(Cart::class, 'maSP');

    }

    public function Provide():BelongsTo{
        return $this->belongsTo(Provide::class, 'idNCC');
    }
}