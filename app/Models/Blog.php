<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class blog extends Model
{
    use HasFactory;
    protected $table = 'blog';
    protected $guarded = [];
    // public $timestamps = false;
    protected $primaryKey = 'maBlog';


    public function Animal():BelongsTo{
        return $this->belongsTo(Animal::class, 'idanimal');

    }

    public function Comment():HasMany{
        return $this->hasMany(Comment::class, 'idblog');

    }

    public function ImageBlog():HasMany{
        return $this->hasMany(ImageBlog::class, 'idblog');

    }
}