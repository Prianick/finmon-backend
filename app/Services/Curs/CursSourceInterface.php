<?php


namespace App\Services\Curs;


use Carbon\Carbon;

interface CursSourceInterface
{
    public function getCurses(Carbon $date);
}
