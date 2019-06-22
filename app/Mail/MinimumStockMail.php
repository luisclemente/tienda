<?php

namespace App\Mail;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class MinimumStockMail extends Mailable
{
   use Queueable, SerializesModels;

   private $product;

   public function __construct ( Product $product )
   {
      $this->product = $product;
   }

   public function build ()
   {
      return $this
         ->markdown ( 'emails.minimum_stock' )
         ->with ( 'product', $this->product );
   }
}
