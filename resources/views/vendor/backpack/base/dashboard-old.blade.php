@extends(backpack_view('blank'))

@php
if (config('backpack.base.show_getting_started')) {

} else {
$widgets['before_content'][] = [
'type' => 'jumbotron',
'heading' => trans('backpack::base.welcome'),
'content' => trans('backpack::base.use_sidebar'),
'button_link' => backpack_url('logout'),
'button_text' => trans('backpack::base.logout'),
];
}

Widget::add([
    'type' => 'inactiveitems',
    'wrapper' => ['class' => 'col-sm-12'],
    'content' => [
        'items' => (new \App\Http\Controllers\WidgetController())->disableditems(),
    ],
]);
Widget::add([
    'type' => 'itemWithExportMport',
    'wrapper' => ['class' => 'col-sm-12'],
    'content' => [
        'items' => (new \App\Http\Controllers\WidgetController())->itemWithExportMport(),
    ],
]);
@endphp

@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="text-value">89.9%</div>
                <div>Lorem ipsum...</div>
                <div class="progress progress-xs my-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">Lorem ipsum dolor sit amet enim.</small>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="text-value">12.124</div>
                <div>Lorem ipsum...</div>
                <div class="progress progress-xs my-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">Lorem ipsum dolor sit amet enim.</small>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="text-value">$98.111,00</div>
                <div>Lorem ipsum...</div>
                <div class="progress progress-xs my-2">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">Lorem ipsum dolor sit amet enim.</small>
            </div>
        </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="text-value">2 TB</div>
                <div>Lorem ipsum...</div>
                <div class="progress progress-xs my-2">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-muted">Lorem ipsum dolor sit amet enim.</small>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>

<div class="row">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i>Inactive Items </div>
            <div class="card-body">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Minimum</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inactive_items as $item)
                            
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->code}}</td>
                            <td>{{$item->min}}</td>
                            <td>{{$item->qty}}</td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                </table>
              
                {{$inactive_items->appends(array_except(Request::query(), 'inactive_items'))->links();}}

                <div class="card">
                  <div class="card-header"><i class="fa fa-align-justify"></i> Items With Export Total And Import Total In last Month</div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                      <thead>
                        <tr>
                          <th>Username</th>
                          <th>Date registered</th>
                          <th>Role</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Yiorgos Avraamu</td>
                          <td>2012/01/01</td>
                          <td>Member</td>
                          <td><span class="badge badge-success">Active</span></td>
                        </tr>
                        <tr>
                          <td>Avram Tarasios</td>
                          <td>2012/02/01</td>
                          <td>Staff</td>
                          <td><span class="badge badge-danger">Banned</span></td>
                        </tr>
                        <tr>
                          <td>Quintin Ed</td>
                          <td>2012/02/01</td>
                          <td>Admin</td>
                          <td><span class="badge badge-secondary">Inactive</span></td>
                        </tr>
                        <tr>
                          <td>Enéas Kwadwo</td>
                          <td>2012/03/01</td>
                          <td>Member</td>
                          <td><span class="badge badge-warning">Pending</span></td>
                        </tr>
                        <tr>
                          <td>Agapetus Tadeáš</td>
                          <td>2012/01/21</td>
                          <td>Staff</td>
                          <td><span class="badge badge-success">Active</span></td>
                        </tr>
                      </tbody>
                    </table>
                    <ul class="pagination">
                      <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                      <li class="page-item active"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">4</a></li>
                      <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                  </div>
                </div>
              </div>
@endsection