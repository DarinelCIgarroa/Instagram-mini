<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function config(){
        
        return view('user.config');
    }

    public function update(Request $request){
        //Conseguir al usuario logueado
     
        
        $user = Auth::user();

        $id = $user->id;

        // Validar los datos
        $validate = $request->validate([
            'name'          => 'required|string|max:255',
            'surname'       => 'required|string|max:255',
            'description'   => 'nullable|string|max:255',
            'nick'          => 'required|string|max:255|unique:users,nick,'. $id,
            'email'         => 'required|string|max:255|unique:users,email,'. $id,
            'image'         => 'nullable|mimes:jpeg,png',
        ]);

        // Recoger los datos del formulario
        $name           = $request->input('name');
        $surname        = $request->input('surname');
        $nick           = $request->input('nick');
        $description    = $request->input('description');
        $email          = $request->input('email');
           
        
        // Asignar nuevos valores al objeto usuario
        $user->name        = $name;
        $user->surname     = $surname;
        $user->nick        = $nick;
        $user->description = $description;
        $user->email       = $email;

        // Subir la imagen

        //Recoger la imagen del formulario
        $image_path = $request->file('image');

        if($image_path){
            // poner nombre unico (time)
            $image_path_name = time().$image_path->getClientOriginalName();

            //Guardar en la carpeta Storage (Storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            // Seteo el nombre de la imagen en el objeto en la base de datos
            $user->image = $image_path_name;
        }
        
        // Ejucutar consulta y cambios a la base de datos
        $user->update();

        // Retorna a la ultima vista cargada con un mensaje de sesion
        return back()->with('status','Datos actualizados correctamente');

    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        
        return new Response($file, 200);
    }

    public function profile(User $user){
       
        $images = Image::select('image_path','created_at','id', 'description','user_id')
                    ->whereUser_id($user->id)
                    ->latest()
                    ->paginate(5);
      
        $publications = Image::select('id')
                        ->whereUser_id($user->id)
                        ->count();
                 
        return view('user.index', compact('images','publications', 'user'));
    }

    public function peoples(){
        $users = User::select('id','name','created_at','description','image')
                ->get();
        
        return view('peoples.index',compact('users'));
    }

}
