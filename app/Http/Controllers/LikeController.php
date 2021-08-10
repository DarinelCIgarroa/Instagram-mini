<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Image;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likes(Image $image){
        
        $user = \Auth::user();

        $isset_like = Like::where('user_id', $user->id)
                        ->where('image_id', $image->id)
                        ->count();

       if($isset_like == 0){
        $like = Like::create([
            'user_id'   => $user->id,
            'image_id'  => $image->id,  
        ]);
        
        return response()->json([
            'like' => $like
        ]);
       
       }else{
           return response()->json([
               'message' => 'Ya has dado like a esta publicacion'
           ]);
       }
        
        
    }

    public function dislike(Image $image){
        
        $user = \Auth::user();
       
        $like = Like::where('user_id', $user->id)
                        ->where('image_id', $image->id)
                        ->first();

       if($like){
        
        $like->delete();

        return response()->json([
            'like'      => $like,
            'message'   => 'Like eliminado',
        ]);
       
       }else{
           return response()->json([
               'message' => 'Aún no has dado like',
           ]);
        }
    }

    public function favorites(){
        
        $user = \Auth::user();

        $likes = Like::whereUser_id($user->id)
                    ->latest()->paginate(5);

        return view('likes.index',compact('likes'));
    }
}