<?php

return [
    'host' => 'http://www.cbr.ru',
    'tails' => [
        'daily' => '/scripts/XML_daily.asp'
    ],
    'currencies' => [
        "AUD","AZN","GBP","AMD","BYN","BGN","BRL","HUF","HKD","DKK","USD","EUR",
        "INR","KZT","CAD","KGS","CNY","MDL","NOK","PLN","RON","XDR","SGD","TJS",
        "TRY","TMT","UZS","UAH","CZK","SEK","CHF","ZAR","KRW","JPY"
    ],
    'withCache' => env('CURRENCIES_WITH_CACHE', true)
];
