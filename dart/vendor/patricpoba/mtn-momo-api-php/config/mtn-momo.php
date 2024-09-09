<?php

/*
 * Configurations for MTN Momo Account.
 */

return [
  

    // Momo API transaction currency code.
    'currency'          => env('MTN_MOMO_CURRENCY', 'EUR'),
  

    'environment'       => env('MTN_MOMO_ENVIRONMENT', 'sandbox'),
 

    'base_url'          => env('MTN_MOMO_API_BASE_URI', 'https://sandbox.momodeveloper.mtn.com/'),
      

    'collection' => [

        'api_secret'    => env('f2451a4a-d68d-4fa4-a40e-788aaef894b4'),
        
        'primary_key'   => env('71f3fe018b1a47a8ac83678dc44772ac'),

        'user_id'       => env('f2451a4a-d68d-4fa4-a40e-788aaef894b4'),

        'callback_url'  => env('https://webhook.site/a6f42fcc-bfac-46ea-b5c4-4ce0f7025890')
    ],
 

    'disbursement' => [

        'primary_key'   => env('MTN_MOMO_DISBURSEMENT_PRIMARY_KEY'),

        'api_secret'    => env('MTN_MOMO_DISBURSEMENT_API_SECRET'),

        'user_id'       => env('MTN_MOMO_DISBURSEMENT_USER_ID'),

        'callback_url'  => env('MTN_MOMO_DISBURSEMENT_CALLBACK_URL')
    ],
 

    'remittance' => [

        'primary_key'   => env('MTN_MOMO_REMITTANCE_PRIMARY_KEY'),

        'api_secret'    => env('MTN_MOMO_REMITTANCE_API_SECRET'),

        'user_id'       => env('MTN_MOMO_REMITTANCE_USER_ID'),

        'callback_url'  => env('MTN_MOMO_REMITTANCE_CALLBACK_URL')
    ],
];
