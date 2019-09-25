<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::where('email','omar@gmail.com')->first();

        if (!$user) {
        	User::create([
        		'name'=>'Omar',
        		'email'=>'omar@gmail.com',
        		'password'=>Hash::make('00000000'),
                'role'=>'admin'
           	]);
        }
    }
}
