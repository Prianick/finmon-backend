<?php


namespace App\Services\Curs;

use Carbon\Carbon;

class CBRSource implements CursSourceInterface
{
    const DAILY = 'http://www.cbr.ru/scripts/XML_daily.asp';

    public function getCurses(Carbon $date): array
    {
        $params = ['date_req' => $date->format('d/m/Y')];
        $url = self::DAILY;

        return $this->query($url, $params);
    }

    protected function query(string $url, array $params)
    {
        try {
            $xml = simplexml_load_file($url . '?' . http_build_query($params));
            $json = json_encode($xml);
            $data = json_decode($json, true);
        } catch (Exception $e) {
            $data = ['error' => $e->getMessage()];
        }
        return $data;
    }
}
