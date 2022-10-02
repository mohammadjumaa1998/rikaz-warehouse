@extends(backpack_view('blank'))

@php
if (config('backpack.base.show_getting_started')) {
    Widget::add([
    'type' => 'inactiveitems',
    'wrapper' => ['class' => ''],
    'content' => [
        'inactive_items' => (new \App\Http\Controllers\Admin\AdminController())->inactveitems(),
    ],
]);
Widget::add([
    'type' => 'items_with_sum',
    'wrapper' => ['class' => ''],
    'content' => [
        'items_with_sum' => (new \App\Http\Controllers\Admin\AdminController())->items_with_sum(),
    ],
]);
Widget::add([
    'type' => 'items_with_sum_last_month',
    'wrapper' => ['class' => ''],
    'content' => [
        'items_with_sum_last_month' => (new \App\Http\Controllers\Admin\AdminController())->items_with_sum_last_month(),
    ],
]);
Widget::add([
    'type' => 'minimumitems',
    'wrapper' => ['class' => ''],
    'content' => [
        'minimumitems' => (new \App\Http\Controllers\Admin\AdminController())->minimumitems(),
    ],
]);
}
@endphp

@section('content')

              
@endsection