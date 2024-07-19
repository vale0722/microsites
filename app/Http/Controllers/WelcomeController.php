<?php

namespace App\Http\Controllers;

use App\Constants\Currency;
use App\Constants\DocumentTypes;
use App\Constants\PaymentGateway;
use App\Models\Site;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function __invoke(): View
    {
        return view('welcome', [
            'sites' => Site::all(),
            'currencies' => Currency::toArray(),
            'documentTypes' => DocumentTypes::toArray(),
            'gateways' => PaymentGateway::toOptions(),
        ]);
    }
}
