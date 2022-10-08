<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\SupplierResource;
use App\Models\Emport;
use App\Models\Export;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function invoiceCustomer()
    {
        $customer = auth()->user()->customer;
        if (!$customer) {
            return response()->error('this is not user');
        }
        $data = Export::with('item')->where('customer_id', $customer->id)->get();
        $grand_total = 0;
        foreach ($data as  $d) {
            $grand_total += $d->qty * $d->item->price;
        }
        $expotrs =  CustomerResource::collection($data);
        return array('success' => true, 'expotrs' => $expotrs, 'message' => 'Returned all data.', 'total_expotrs' => $expotrs->sum('qty'), 'expotrs_count' => $expotrs->count(), 'grand_total' => $grand_total);
    }



    public function invoiceSupplier()
    {
        $supplier = auth()->user()->supplier;
        if (!$supplier) {
            return response()->error('this is not user');
        }
        $data = Emport::with('item')->where('supplier_id', $supplier->id)->get();
        $grand_total = 0;
        foreach ($data as  $d) {
            $grand_total += $d->qty * $d->item->price;
        }
        $imports =  SupplierResource::collection($data);
        return array('success' => true, 'imports' => $imports, 'message' => 'Returned all data.', 'total_imports' => $imports->sum('qty'), 'imports_count' => $imports->count(), 'grand_total' => $grand_total);
    }
}
