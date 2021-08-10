<?php

namespace App\Models;


use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $table = "images";

    protected $fillable = [
        'user_id',
        'image_path',
        'description',
    ];

    public function likes(){

        return $this->hasMany(Like::class)->OrderBy('id','DESC');
    }

    public function comments(){

        return $this->hasMany(Comment::class)->OrderBy('id','DESC');
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

    // Scope
    public function scopeDescription($query, $description){
        if($description)
            return $query->where('description', 'LIKE', "%$description%");    
    }

    public function scopeName($query, $name) {
        return $query->whereHas('user', function(Builder $subQuery) use ($name) {
                    $subQuery->where('name','LIKE', "%$name%");
                });
     }

}
