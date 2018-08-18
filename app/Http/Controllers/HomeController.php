<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'user_verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_invoices      = Invoice::count();
        $total_cost          = Invoice::sum('cost');
        $total_weight        = Invoice::sum('weight');
        $total_cost_per_unit = round($total_cost / $total_weight, 2);

        $stats = [
            'total_invoices'      => $total_invoices,
            'total_cost'          => '$' . $total_cost,
            'total_weight'        => $total_weight . 'LB',
            'total_cost_per_unit' => '$' . $total_cost_per_unit,
        ];

        return view('home', compact(['stats']));
    }
}
