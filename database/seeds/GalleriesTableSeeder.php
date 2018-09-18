<?php

use Illuminate\Database\Seeder;
use App\User;

class GalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function (User $u){
            $u->galleries()->saveMany(factory(App\Gallery::class, 3)->make());
        });
    }
}
