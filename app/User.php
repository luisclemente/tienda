<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt( $value )
 */
class User extends Authenticatable
{
   use Notifiable;

   protected $fillable = [
      'name', 'email', 'password', 'phone', 'address', 'user_name'
   ];

   protected $hidden = [
      'password', 'remember_token',
   ];

   protected $casts = [
      'email_verified_at' => 'datetime',
   ];

   protected $dates = ['last_logged_at'];

   public function carts ()
   {
      return $this->hasMany ( Cart::class );
   }

   public function orders ()
   {
      return $this->hasMany ( Order::class );
   }

   public function getCartAttribute ()
   {
      $cart = $this->carts ()->where ( 'status', 'active' )->first ();
      if ( $cart )
         return $cart;

      $cart = new Cart();
      $cart->status = 'active';
      $cart->user_id = $this->id;
      $cart->save ();

      return $cart;
   }

   public function getCartPendingAttribute ()
   {
      $carts = $this->carts ()->where ( 'status', 'pending' )->get ();
      if ( $carts )
         return $carts;
   }


   public function getNumberOrdersAttribute ()
   {
      $carts = $this->carts ()->where ( 'order_date', '!=', null )->get ();

      return count ( $carts );
   }

   public function getTotalAmountAttribute ()
   {
      $total = 0;
      $carts = $this->carts ()->where ( 'order_date', '!=', null )->get ();

      foreach ( $carts as $cart )
         foreach ( $cart->details as $detail )
            $total += $detail->subtotal;

      return $total;
   }
}
