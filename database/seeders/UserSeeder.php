<?php

namespace Database\Seeders;


use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'       => 'Admin',
                'email'      => 'admin@mail.com',
                'username'   => 'admin',
                'password'   => bcrypt('admin@123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];

        //DB::table('users')->truncate();
        User::insert($data);
    }


}
