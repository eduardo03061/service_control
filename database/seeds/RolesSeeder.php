<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        DB::table('roles')-> insert([
            'Rol' => "admin",
        ]);

        DB::table('roles')-> insert([
            'Rol' => "user",
        ]);
    }
}
