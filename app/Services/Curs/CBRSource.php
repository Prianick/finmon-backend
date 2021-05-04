<?php


namespace App\Services\Curs;

use Carbon\Carbon;

class CBRSource implements CursSourceInterface
{
    public string $dailyRoute;

    public function __construct()
    {
        $this->dailyRoute = config('cursService.host') . config('cursService.tails.daily');
    }

    public function getCurses(Carbon $date): array
    {
        $params = ['date_req' => $date->format('d/m/Y')];

        return $this->query($this->dailyRoute, $params);
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
