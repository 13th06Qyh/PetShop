<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $guarded = [];
    // public $timestamps = false;
    protected $primaryKey = 'maBL';


    public function User():BelongsTo{
        return $this->belongsTo(User::class, 'iduser');

    }

    public function Blog():BelongsTo{
        return $this->belongsTo(Blog::class, 'idblog');

    }
}