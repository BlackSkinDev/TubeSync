<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

     protected $fillable = [
        'party_id',
        'creator',
        'status',
        'url',
    ];

    public function creator(){
    	 return $this->belongsTo(User::class, 'creator', 'id');
    }
}
