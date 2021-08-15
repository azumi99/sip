<?php

namespace App\Imports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;

class TransactionImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!isset($row[0]) == 'product_id') {
            return null;
        }
        return new Transaction([
            'product_id'    => $row[0],
            'trx_date '     => $row[1],
            'price'         => $row[2]
        ]);
    }
}
