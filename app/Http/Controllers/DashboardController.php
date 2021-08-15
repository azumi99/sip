<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TransactionControler;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {

        // $transaction = DB::table('transactions')
        //     ->select('trx_date', DB::raw('count(*) as total'))
        //     ->groupBy('trx_date')
        //     ->get();

        // $chart = [
        //     'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        //     'totals' => [$transaction]
        // ];

        $sql = "select monthname(trx_date) month, count(*) total from transactions group by monthname(trx_date) order by month(trx_date)";
        $transaction = DB::select($sql);

        $months = [];
        $totals = [];

        foreach ($transaction as $key => $transaction) {
            $months[] = $transaction->month;
            $totals[] = $transaction->total;
        }
        $chart = [
            'months' => $months,
            'totals' => $totals,
        ];

        $latest_transaction = Transaction::orderBy('trx_date', 'desc')
            ->select('transactions.*', 'pruducts.name as product_name')
            ->join('pruducts', 'pruducts.id', '=', 'transactions.product_id')
            ->limit(4)
            ->get();

        $product = Transaction::selectRaw('pruducts.name as product_name, count(*) as total')
            ->join('pruducts', 'pruducts.id', '=', 'transactions.product_id')
            ->groupBy('product_name')
            ->get();

        $product_name = [];
        $product_total = [];
        $product_color = [];

        foreach ($product as $key => $value) {
            $product_name[] = $value->product_name;
            $product_total[] = $value->total;
            $product_color[] = "rgb(" . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ")";
        }

        $chart_product = [
            'product_name' => $product_name,
            'product_total' => $product_total,
            'product_color' => $product_color
        ];

        return view('dashboard', compact('chart', 'latest_transaction', 'chart_product'));
    }
}
