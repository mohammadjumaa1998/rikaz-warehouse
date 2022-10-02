<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin')     => backpack_url('dashboard'),
            trans('backpack::base.dashboard') => false,
        ];

        $this->data['inactive_items'] = Item::where('active', 0)->paginate(5, '*', 'inactive_items');
        $this->data['items'] = Item::get();
        $this->data['items_with_count'] = Item::with('customer')->with('supplier')->paginate(5, '*', 'items_with_count');
        return view(backpack_view('dashboard'), $this->data);
    }
}
