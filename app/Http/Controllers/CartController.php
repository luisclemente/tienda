<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function update ()
    {
        $cart = auth()->user ()->cart;
        $cart->status = 'pending';
        $cart->save();

        return back()->with('status', 'Tu pedido ha sido registrado. Te contactaremos pronto vía email');
    }
}
