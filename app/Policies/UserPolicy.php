<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
   use HandlesAuthorization;

   public function userWithCart ( User $user )
   {
     // $user = User::find ( 6 );
    //  dd ( $user->carts->contains ( 'status', 'pending' ) );
      dd ( $user->carts->count());

      //dd( $user, $user->carts );
      //return $user->carts;
      return $user->carts->contains ( 'status', 'active' ) || $user->carts->contains ( 'status', 'pending' );
      //return false;
   }
}
