<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;

class InvoiceController extends Controller
{
    public function index(): View
    {
        $invoices = Invoice::latest()->paginate();

        return view('invoices.index', [
            'invoices' => $invoices,
        ]);
    }
}
