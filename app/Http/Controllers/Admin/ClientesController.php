<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;

class ClientesController extends Controller
{
   public function index ()
   {
      $users = User::Has('carts')->get();
      return view ( 'admin.clients.index', compact ( 'carts', 'users' ) );
   }
}
