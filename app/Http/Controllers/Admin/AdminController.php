<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
     return  Item::with('getLastExport')->with('supplier')
     
     ->paginate(5, '*', 'items_with_sum_last_month');

    }
    public function minimumitems()
    {

        return Item::where('qty','<=', 'min')->paginate(5, '*', 'minimumitems');
    }
   
}