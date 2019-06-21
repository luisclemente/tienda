<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run ()
   {
      User::create ( [
         'name' => 'luis',
         'email' => 'luis@email.com',
         'user_name' => 'luis',
         'password' => bcrypt ( '.' ),
         'admin' => true
      ] );

      User::create ( [
         'name' => 'espe',
         'email' => 'espe@email.com',
         'user_name' => 'espe',
         'password' => bcrypt ( '.' ),
         'admin' => false
      ] );

   }
}
