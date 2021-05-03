<?php

namespace Tests\Mocks;

use App\Services\Curs\CBRSource;
use App\Services\Curs\CursSourceInterface;
use Carbon\Carbon;

class FakeCBRSource extends CBRSource implements CursSourceInterface
{
    public function getCurses(Carbon $date): array
    {
        $testData = base_path() . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'Mocks' . DIRECTORY_SEPARATOR . 'testData.xml';
        try {
            $xml = simplexml_load_file($testData);
            $json = json_encode($xml);
            $data = json_decode($json, true);
        } catch (Exception $e) {
            $data = ['error' => $e->getMessage()];
        }

        return $data;
    }
}
