<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\Image;

class ImageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function create(){

        return view('images.create');
    }

    public function save(Request $request){

        //Conseguir al usuario logueado
        $user = Auth::user();

        $id = $user->id;

        // Validamos los datos que llegan del formulario
        $validate = $request->validate([
            'user_id'       =>  'exists:App\Models\User,id',
            'image_path'    =>  'required|file|mimes:jpeg,png',
            'description'   =>  'nullable|string|max:255',
        ]);
        
        // Obtenemos la imagen del formulario
        $image_path = $request->file('image_path');

        if($image_path){
            // Asignamos un nombre unicio
            $image_path_name = time().$image_path->getClientOriginalName();
            // Guardar la imagen en bruto en nuestro disco local
            Storage::disk('images')->put($image_path_name, File::get($image_path));
        }
        
        // Seteamos los registros a la base de datos
        Image::create([
        'user_id'       =>  $id,
        'description'   =>  Request('description'),
        'image_path'    =>  $image_path_name,  
        ]);

        return redirect()->route('home')->with('success','Imagen publicada correctamente');
    
    }
    
    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        
        return new Response($file, 200);
    }
    
    public function show(Image $image){

        return view('images.detail', compact('image'));
    }
    
    public function update(Request $request){
        return 'hola';
    }

    public function delete(Request $request){
        
        $image = Image::findOrfail($request->image_id);
        
        $this->authorize('delete', $image);
        Storage::disk('images')->delete($image->image_path);
        $image->delete();

        return back()->withInput()->with('info','Publicación eliminada correctamente');
    }
}