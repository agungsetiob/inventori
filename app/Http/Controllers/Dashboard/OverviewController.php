<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSupplies;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    public function index () {
        $countProducts = Product::count();
        $countProductIncome = ProductSupplies::where('type', 'income')->count();
        $countProductOutcome = ProductSupplies::where('type', 'outcome')->where('status', 'approved')->count();
        //for mysql
        // $yearlyProductCounts = Product::selectRaw('YEAR(created_at) as year, COUNT(*) as count')
        //     ->where('created_at', '>=', now()->subYears(7))
        //     ->groupBy('year')
        //     ->orderBy('year')
        //     ->pluck('count', 'year');
        //for posgresql
        $yearlyProductCounts = Product::selectRaw('EXTRACT(YEAR FROM created_at) as year, COUNT(*) as count')
            ->where('created_at', '>=', now()->subYears(7))
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('count', 'year');

        $labels = $yearlyProductCounts->keys();
        $data = $yearlyProductCounts->values();
        return view('dashboard.overview.index',
         [
            'countProducts'=>$countProducts,
            'countProductIncome'=>$countProductIncome,
            'countProductOutcome'=>$countProductOutcome,
            'labels'=>$labels,
            'data'=>$data
        ]);
    }
}
