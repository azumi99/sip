<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Transaction;
use App\Imports\TransactionImport;
use Session;
use Excel;

class TransactionControler extends Controller
{
    public function index()
    {
        $transaction = new Transaction();

        $transaction = Transaction::select('transactions.*', 'pruducts.name as product_name')
            ->join('pruducts', 'pruducts.id', '=', 'transactions.product_id')
            ->get();

        return view('transaction.index', compact('transaction'));
    }
    public function create()
    {
        return view('transaction.create');
    }
    public function import(Request $request)
    {
        $rules = [
            'file_excel'           => 'required|mimes:xls,xlsx',
        ];

        $messege = [
            'file_excel.required'           => 'File wajib diisi',
            'file_excel.mimes'              => 'File hanya boleh bertipe xls,xlsx',
        ];

        $validator = Validator::make($request->all(), $rules, $messege);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        $path = $request->file('file_excel')->getRealPath();
        $data = Excel::import(new TransactionImport, $path);
        Session::flash('messege', 'Data berhasil di import');
        return redirect()->route('transaction.index');
    }
}
