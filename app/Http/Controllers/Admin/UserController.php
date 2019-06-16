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

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function store ( Request $request )
   {
      $pass = bcrypt ('secret');
      $request->merge (['password' => $pass]);
      User::create ( $request->all () );
      return back ()->with('message', 'Usuario añadido con éxito');
   }

   /**
    * Display the specified resource.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function show ( $id )
   {

   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function edit ( User $user )
   {
      return view ( 'admin.users.edit', compact ( 'user' ) );
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function update ( Request $request, User $user)
   {
      $user->update ( $request->all () );
      return redirect ($request->previous_url);
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    * @throws \Exception
    */
   public function destroy ( User $user )
   {
      $user->delete();
   }


}
