<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
        factory(App\User::class, 100)->create()->each(function ($user) {
            $user->files()->saveMany(factory(App\File::class, 20)->make());
            $user->shared()->saveMany(factory(App\File::class, 25)->make());
        });
    }
}
