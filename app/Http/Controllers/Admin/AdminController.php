<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Export;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function inactveitems()
    {

        return Item::where('active', 0)->paginate(5, '*', 'inactive_items');
    }

    public function items_with_sum()
    {
     return  Item::with('customer')->with('supplier')->paginate(5, '*', 'items_with_sum');

    }
    public function items_with_sum_last_month()
    {
        return  Item::with(
            [
            'customer' => function ($export) {$export->where(DB::raw('MONTH(date)'),Carbon::now()->subMonth()->month);},
            'supplier' => function ($import) {$import->where(DB::raw('MONTH(date)'),Carbon::now()->subMonth()->month);},
            ]
               )->paginate(5, '*', 'items_with_sum_last_month');

    }

    public function topexport()
    {
   return Export::with('item')->orderBy('qty','DESC')
     ->take(10)->get();


    }
    public function minimumitems()
    {

        return Item::where('qty','<=', 'min')->paginate(5, '*', 'minimumitems');
    }
   
}
