<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new \App\Models\User();
        $user1->name = 'admin';
        $user1->email = 'admin@admin.lt';
        $user1->password = Hash::make('adminadmin');
        $user1->save();
    }
}
