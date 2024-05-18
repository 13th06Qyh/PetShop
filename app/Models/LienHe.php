<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LienHe extends Model
{
    use HasFactory;
    protected $table = 'lienhe';
    protected $fillable = [
        'user_id',
    ];
    public function insert($data){
        return DB::table($this->table)
        ->insert($data);
    }
    
}