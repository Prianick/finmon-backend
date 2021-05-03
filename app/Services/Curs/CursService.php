<?php

namespace App\Services\Curs;

use Carbon\Carbon;

class CursService
{
    const DEFAULT_CURRENCY = 'RUB';
    const AUD = 'AUD';
    const RUB = 'RUB';
    const GBP = 'GBP';
    const BYR = 'BYR';
    const DKK = 'DKK';
    const USD = 'USD';
    const EUR = 'EUR';
    const TRL = 'TRL';
    const KGS = 'KGS';
    const MDL = 'MDL';
    const JPY = 'JPY';
    const SEK = 'SEK';

    const CURRENCIES = [
        self::AUD, self::GBP, self::BYR, self::DKK, self::USD, self::EUR, self::TRL, self::DEFAULT_CURRENCY
    ];

    protected CursSourceInterface $source;

    public function __construct(CursSourceInterface $source)
    {
        $this->source = $source;
    }

    public function getCurses(string $currencyCode1, string $currencyCode2, Carbon $date)
    {
        $currency1 = [];
        $currency2 = [];

        if ($currencyCode1 == self::DEFAULT_CURRENCY) {
            $currency1 = $this->getRubParams();
        }
        if ($currencyCode2 == self::DEFAULT_CURRENCY) {
            $currency2 = $this->getRubParams();
        }

        $curses = $this->source->getCurses($date);
        foreach ($curses['Valute'] as $curs) {
            if ($currencyCode1 == $curs['CharCode']) {
                $currency1 = $curs;
            }
            if ($currencyCode2 == $curs['CharCode']) {
                $currency2 = $curs;
            }
            if (count($currency1) != 0 and count($currency2) != 0) {
                break;
            }
        }

        if (count($currency1) == 0 || count($currency2) == 0) {
            $wrongCurrencies = [];
            if (count($currency1) == 0) {
                $wrongCurrencies[] = $currencyCode1;
            }
            if (count($currency2) == 0) {
                $wrongCurrencies[] = $currencyCode2;
            }
            throw new \Exception('Currency(' . implode(',', $wrongCurrencies) . ') didn\'t find');
        }

        return $this->calculate($currency1, $currency2);
    }

    protected function getRubParams()
    {
        return [
            'NumCode' => 643,
            'CharCode' => self::DEFAULT_CURRENCY,
            'Nominal' => 1,
            'Name' => 'Российский рубль',
            'Value' => 1
        ];
    }

    public function calculate(array $currency1, array $currency2)
    {
        $value1 = 1 / ((float)$currency1['Value'] / (float)$currency1['Nominal']);
        $value2 = 1 / ((float)$currency2['Value'] / (float)$currency2['Nominal']);
        return round($value2 / $value1, 4);
    }
}
