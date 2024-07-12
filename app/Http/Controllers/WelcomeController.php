<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\View\View;
use App\Constants\Currency;
use App\Constants\DocumentTypes;
use App\Constants\PaymentGateway;

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
