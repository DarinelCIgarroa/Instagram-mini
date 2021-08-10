<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Image;
use App\Models\Like;
use App\Models\Comment;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'users',
            'images',
            'likes',
            'comments'
        ]);
        
        User::factory(10)->create();
        Image::factory(10)->create();
        Like::factory(10)->create();
        Comment::factory(10)->create();

        $this->call([
            UserSeeder::class,
        ]);
    }

    public function truncateTables(array $tables){

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach($tables as $table){
            DB::table($table)->truncate();
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
