<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

     protected $fillable = [
        'party_id',
        'user_id',
        'content',
       
    ];

     public function user(){
    	 return $this->belongsTo(User::class);
    }

    public function party(){
         return $this->belongsTo(Party::class);
    }

    public function getCreatedAtAttribute($value){
    	return Carbon::parse($value)->diffForHumans();
    }

}
