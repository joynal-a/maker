<?php

namespace Abedin\Maker\Controllers;

use Abedin\Maker\Lib\Traits\ManagerTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class MarketController extends Controller
{
    use ManagerTrait;
    public function index()
    {
        $response = Http::get('http://razinsoft.test/api/envato-products/' . config('installer.productId'));
        $products = $response->json()['data'];

        return view('joynala.maker::market.index', compact('products'));
    }

    public function upgrade()
    {
        $response = Http::post('http://razinsoft.test/api/check/product-update/' . config('installer.productId'), [
            'key' => self::getPurchaseKey()
        ]);
        $data = $response->json()['data'];

        $logPath = storage_path('logs/change.json');
        $logs = [];
        if (file_exists($logPath)) {
            $logContent = file_get_contents($logPath);
            $logs = json_decode($logContent, true);
        }

        return view('joynala.maker::market.upgrade', compact('data', 'logs'));
    }
}

