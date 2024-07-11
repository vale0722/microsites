<?php

namespace App\Http\Controllers;

use App\Constants\Currency;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function __invoke(): View
    {
        return view('welcome', [
            'sites' => Site::all(),
            'currencies' => Currency::toArray(),
        ]);
    }
}
