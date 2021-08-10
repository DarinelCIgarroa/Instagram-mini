<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Image;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

    protected $fillable = [
        'id',
        'user_id',
        'image_id',
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function image(){

        return $this->belongsTo(Image::class);
    }
}
