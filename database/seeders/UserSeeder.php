<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $user->role        =   "admin";
        $user->name        =   "Darinel";
        $user->surname     =   "Cigarroa De Los Santos";
        $user->nick        =   "darinel293";
        $user->description =   "descripción de mi perfil";
        $user->email       =   "darinelcigarroa97@gmail.com";
        $user->password    =   bcrypt('123');
        $user->image       =   "null-profile.png";

        $user->save();

        $user = new User();

        $user->role        =   "user";
        $user->name        =   "Zincri";
        $user->surname     =   "Mendoza Lopez";
        $user->nick        =   "Zincri";
        $user->description =   "descripción del perfil de Zincri";
        $user->email       =   "zincri@zincri.com";
        $user->password    =   bcrypt('123');
        $user->image       =   "null-profile.png";

        $user->save();
    }
}
