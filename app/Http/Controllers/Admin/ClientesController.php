<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;

class ClientesController extends Controller
{
   public function index ()
   {
      $users = User::whereHas ( 'carts', function ( $q ) {
         $q->where ( 'order_date', '!=', null );
      } )->get ();

      return view ( 'admin.clients.index', compact ( 'users' ) );
   }

   public function showcarts (User $user)
   {
      return view('admin.clients.ordered_carts', compact ('user'));
   }
}
