<?php

namespace App\Http\Controllers;

use Config;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use App\Order;
use App\OrderItem;


class PaypalController extends Controller
{
   private $_api_context;

   public function __construct ()
   {
      // setup PayPal api context
      $paypal_conf = \Config::get ( 'paypal' );
      $apiContext = new OAuthTokenCredential( $paypal_conf[ 'client_id' ], $paypal_conf[ 'secret' ] );
      $this->_api_context = new ApiContext( $apiContext );
      $this->_api_context->setConfig ( $paypal_conf[ 'settings' ] );
   }

   public function postPayment ()
   {
      $payer = new Payer();
      $payer->setPaymentMethod ( 'paypal' );

      $items = array ();
      $subtotal = 0;
      $cart = auth ()->user ()->cart;
      $cartDetails = auth ()->user ()->cart->details;
      //$cart = \Session::get ( 'cart' );
      //dd($cart);
      $currency = 'EUR';

      foreach ( $cartDetails as $producto )
      {
         $item = new Item();
         $item->setName ( $producto->name )
            ->setCurrency ( $currency )
            ->setDescription ( $cart->description )
            ->setQuantity ( $producto->quantity )
            ->setPrice ( $producto->price );

         $items[] = $item;
         $subtotal += $producto->quantity * $producto->price;
         //$subtotal = $producto->subtotal ;
      }

      $item_list = new ItemList();
      $item_list->setItems ( $items );

      $details = new Details();
      $details->setSubtotal ( $subtotal )->setShipping ( 100 ); // GASTOS DE ENVÍO

      $total = $subtotal + 100;

      $amount = new Amount();
      $amount->setCurrency ( $currency )->setTotal ( $total )->setDetails ( $details );

      $transaction = new Transaction();
      $transaction->setAmount ( $amount )
         ->setItemList ( $item_list )
         ->setDescription ( 'Pedido de prueba' );

      $redirect_urls = new RedirectUrls();
      $redirect_urls->setReturnUrl ( \URL::route ( 'payment.status' ) )
         ->setCancelUrl ( \URL::route ( 'payment.status' ) );

      $payment = new Payment();
      $payment->setIntent ( 'Sale' )
         ->setPayer ( $payer )
         ->setRedirectUrls ( $redirect_urls )
         ->setTransactions ( array ( $transaction ) );

      try
      {
         $payment->create ( $this->_api_context );

      } catch ( \PayPal\Exception\PayPalConnectionException $ex )
      {
         if ( \Config::get ( 'app.debug' ) )
         {
            echo "Exception: " . $ex->getMessage () . PHP_EOL;
            $err_data = json_decode ( $ex->getData (), true );
            exit;
         } else
         {
            echo '<pre>';print_r(json_decode($ex->getData()));exit;
           // die( 'Ups! Algo salió mal' );
         }
      }

      foreach ( $payment->getLinks () as $link )
      {
         if ( $link->getRel () == 'approval_url' )
         {
            $redirect_url = $link->getHref ();
            break;
         }
      }
      // add payment ID to session
      \Session::put ( 'paypal_payment_id', $payment->getId () );

      if ( isset( $redirect_url ) )
      {
         // redirect to paypal
         return \Redirect::away ( $redirect_url );
      }

      return \Redirect::route ( 'home' )->with ( 'error', 'Ups! Error desconocido.' );
   }
/*
 * - 1. Get the payment ID before session clear
 * - 2. Clear the session payment ID
 * - 3. PaymentExecution object includes information necessary to execute a PayPal account payment. The payer_id is
 *       added to the request query parameters when the user is redirected from paypal back to your site
 * - 4. Execute the payment.
 */
   public function getPaymentStatus ()
   {
      $payment_id = \Session::get ( 'paypal_payment_id' ); // 1
      \Session::forget ( 'paypal_payment_id' ); // 2
      $payerId = Input::get ( 'PayerID' );
      $token = Input::get ( 'token' );

      if ( empty( $payerId ) || empty( $token ) )
      {
         return \Redirect::route ( 'home' )->with ( 'message', 'Hubo un problema al intentar pagar con Paypal' );
      }

      $payment = Payment::get ( $payment_id, $this->_api_context ); // 3
      $execution = new PaymentExecution();
      $execution->setPayerId ( Input::get ( 'PayerID' ) );
      $result = $payment->execute ( $execution, $this->_api_context ); // 4

      if ( $result->getState () == 'approved' )
      {
         $this->saveOrder ( auth ()->user()->cart );
         auth ()->user()->cart->delete();
         return \Redirect::route ( 'home' )->with ( 'status', 'Compra realizada de forma correcta' );
      }
      return \Redirect::route ( 'home' )->with ( 'status', 'La compra fue cancelada' );
   }

   private function saveOrder ( $cart )
   {
      $subtotal = 0;

      foreach ( $cart->details as $detail )
      {
         $subtotal += $detail->subtotal;
      }

      $order = Order::create ( [
         'subtotal' => $subtotal,
         'shipping' => 10,
         'user_id'  => auth()->id ()
      ] );

      foreach ( $cart->details as $detail )
      {
         $this->saveOrderItem ( $detail, $order->id );
      }
   }

   private function saveOrderItem ( $detail, $order_id )
   {
      OrderItem::create ( [
         'quantity'   => $detail->quantity,
         'price'      => $detail->price,
         'product_id' => $detail->product_id,
         'order_id'   => $order_id
      ] );
   }

}
