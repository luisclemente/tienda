<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
   public function index ()
   {
      $users = User::all ();
      return view ( 'admin.users.index', compact ( 'users' ) );
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create ()
   {
      return view ( 'admin.users.create' );
   }

   public function store ( Request $request )
   {
      $pass = bcrypt ( 'secret' );
      $request->merge ( [ 'password' => $pass ] );
      User::create ( $request->all () );
//      return back ()->with ( 'message', 'Usuario añadido con éxito' );
      return redirect ( $request->previous_url )->with ( 'message', 'Usuario añadido con éxito' );
   }

   public function show ( $id )
   {

   }

   public function edit ( User $user )
   {
      return view ( 'admin.users.edit', compact ( 'user' ) );
   }

   public function update ( Request $request, User $user )
   {
      $user->update ( $request->all () );
      return redirect ( $request->previous_url );
   }

   public function destroy ()
   {
      $user = User::find ( \request ( 'user_id' ) );

      foreach ( $user->carts as $cart )
         $cart->delete ();

      $user->delete ();

      return back ();
   }


}
