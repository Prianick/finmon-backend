<?php


namespace App\Http\Controllers;


use App\Http\Requests\ExchangeRateRequest;
use App\Services\Curs\CursService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\File;

class CurrencyController extends Controller
{
    public CursService $cursService;

    public function __construct(CursService $cursService)
    {
        $this->cursService = $cursService;
    }

    public function currencyList(Request $request)
    {
        return response()->json($this->cursService->currencies);
    }

    public function exchangeRate(ExchangeRateRequest $request)
    {
        $date = Carbon::createFromFormat('Y-m-d', $request->get('date'));
        $exchangeRate = $this->cursService->getCurses(
            $request->get('currency1'),
            $request->get('currency2'),
            $date
        );

        return response()->json(['exchangeRate' => $exchangeRate, 'date' => $date->format('Y-m-d')]);
    }
}
