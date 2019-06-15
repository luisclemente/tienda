<?php

return [

   // set your paypal credential
   'client_id' => 'AVUNnI6tl4sS9_yBwsAtN7yCVquPeBix8YJ9twOdH47RaQKGULHuUh-FTjDRHeqsYLiUvA0Y9d1m5HN5',
   'secret' => 'ENJYWabJ-xCiHBKZmQlk10PiiP41-LgLhmfZAFtyyuI3_Dog3XqhUPanVVPASuFmRx0qKnyedryzJ21A',
   /**
    * SDK configuration
    */
   'settings' => [
      /**
       * Available option 'sandbox' or 'live'
       */
      'mode' => 'sandbox',
      /**
       * Specify the max request time in seconds
       */
      'http.ConnectionTimeOut' => 30,
      /**
       * Whether want to log to a file
       */
      'log.LogEnabled' => true,
      /**
       * Specify the file that want to write on
       */
      'log.FileName' => storage_path() . '/logs/paypal.log',
      /**
       * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
       *
       * Logging is most verbose in the 'FINE' level and decreases as you
       * proceed towards ERROR
       */
      'log.LogLevel' => 'FINE'
   ],
];
