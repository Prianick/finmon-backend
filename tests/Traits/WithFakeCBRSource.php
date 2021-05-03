<?php

namespace Tests\Traits;

use App\Services\Curs\CursSourceInterface;
use Tests\Mocks\FakeCBRSource;

trait WithFakeCBRSource
{
    public function mockCBRSource()
    {
        app()->bind(CursSourceInterface::class, function () {
            return new FakeCBRSource();
        });
    }
}
