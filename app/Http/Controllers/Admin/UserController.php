<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
   public function index ()
   {
      $users = User::all ();
      return view ( 'admin.users.index', compact ( 'users' ) );
   }

   public function create ()
   {
      return view ( 'admin.users.create' );
   }

   public function store ( UserRequest $request )
   {
      $pass = bcrypt ( 'secret' );
      $request->merge ( [ 'password' => $pass ] );
      User::create ( $request->all () );

      return redirect ( $request->previous_url )->with ( 'status', 'Usuario añadido con éxito' );
   }

   public function edit ( User $user )
   {
      return view ( 'admin.users.edit', compact ( 'user' ) );
   }

   public function update ( UserRequest $request, User $user )
   {
      $user->update ( $request->all () );
      return redirect ( $request->previous_url );
   }

   /**@throws \Exception */
   public function destroy ()
   {
      $user = User::find ( \request ( 'user_id' ) );

      foreach ( $user->carts as $cart )
         $cart->delete ();

      $user->delete ();

      return back ();
   }


}
