<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Image $image){

        return view('images.detail', compact('image'));
    }

    public function save(Image $image, Request $request){
        $id_image = $image->id;

        $user = Auth::user();
        
        $id = $user->id;

        $validate = $request->validate([
            'user_id'   => 'exists:App\Models\User,id',
            'image_id'  => 'exists:App\Models\Image,idImage',
            'content'   => 'required|string|max:255',
        ]);

        Comment::create([
            'user_id'       =>  $id,
            'image_id'      =>  $id_image,
            'content'   =>  Request('content'),
        ]);

        return redirect()->route('comment.show', compact('image'))->with('success','Comentario publicado');
    }

    public function delete(Comment $comment)
    {  
        $this->authorize('delete', $comment);
        
        $comment->delete();

        return back()->withInput()->with('info', 'comentario eliminado');
    }
}