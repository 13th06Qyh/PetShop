<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class imageblog extends Model
{
    use HasFactory;
    protected $table = 'imageblog';
    protected $guarded = [];
    // public $timestamps = false;
    protected $primaryKey = 'maIB';


    public function Blog():BelongsTo{
        return $this->belongsTo(Blog::class, 'idblog');

    }
}