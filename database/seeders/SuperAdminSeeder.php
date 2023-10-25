<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder{
    public function run(): void{
        $is_user = $is_email = $is_password = false;
        do {
            ($is_user === true)? $this->command->error('user is required.') : $is_user = true ;
            echo "input your Username : ";
            $user = trim(fgets(STDIN));
        }while( strlen($user) === 0 );

        do {
            ($is_email === true)? $this->command->error('email invalid .') : $is_email = true ;
            echo "input your email : ";
            $email = trim(fgets(STDIN));
        } while (!(filter_var($email, FILTER_VALIDATE_EMAIL) && strpos($email, "@gmail.com") !== false ));
       
        do {
            echo "Create your Passord : ";
            $password = trim(fgets(STDIN));
            echo "Confirm Passord : ";
            $confirm_password = trim(fgets(STDIN));
            if($is_password === true){
                ($password !== $confirm_password)?  $this->command->error("password don't conformatible with confirm password."):$this->command->error("the password must have at least 8 char .");
            }else {
                $is_password = true ;
            }
        } while ($password !== $confirm_password || strlen($password) < 7 );
      
        User::create([
            'name' => strip_tags($user),
            'email' => strip_tags($email),
            'password' => Hash::make($password),
            'role' => 'super admin',
            'email_verified_at'=> date('Y-m-d H:i:s'),
            'deleted_at' => null,
        ]);
        $this->command->info('Super admin create successfully.');
    }
}