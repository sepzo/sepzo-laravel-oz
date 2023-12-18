<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio', 
        'profile_picture'
    ];


    //  one to one relationship

    public function user(){
        return $this->belongsTo(User::class);
    }
}