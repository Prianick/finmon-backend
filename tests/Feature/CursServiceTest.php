<?php

namespace Tests\Feature;

use App\Services\Curs\CBRSource;
use App\Services\Curs\CursService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\WithFakeCBRSource;
use Tests\TestCase;

class CursServiceTest extends TestCase
{
    use WithFakeCBRSource;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockCBRSource();
    }

    public function testCalculate()
    {
        /** @var CursService $service */
        $service = $this->app->make(CursService::class);
        $curs = $service->getCurses(CursService::EUR, CursService::USD, (new Carbon()));
        $this->assertEquals(1.2162, $curs);
        $curs = $service->getCurses(CursService::USD, CursService::JPY, (new Carbon()));
        $this->assertEquals(108.8235, $curs);
        $curs = $service->getCurses(CursService::SEK, CursService::JPY, (new Carbon()));
        $this->assertEquals(13.0882, $curs);
    }
}
