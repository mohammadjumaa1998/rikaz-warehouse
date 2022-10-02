@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
<div class="{{ $widget['class'] ?? '' }}">
    {{-- {!! $widget['content'] !!} --}}
    <div class="">
    <div class="">
        <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i>items_with_sum  </div>
            <div class="card-body">
                <table class="table table-responsive-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Minimum</th>
                            <th>Qty</th>
                            <th>Sum Exports</th>
                            <th>Sum Imports</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($widget['content']['items_with_sum'] as $item)
                            
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->code}}</td>
                            <td>{{$item->min}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{$item->customer->sum('pivot.qty')}}</td>
                            <td>{{$item->supplier->sum('pivot.qty')}}</td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                </table>
              
                {{$widget['content']['items_with_sum']->appends(array_except(Request::query(), 'items_with_sum'))->links();}}

        <!-- /.col-->
    </div>
</div>

@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')