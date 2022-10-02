@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
<div class="{{ $widget['class'] ?? '' }}">
    {{-- {!! $widget['content'] !!} --}}
    <div class="">
    <div class="">
        <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i>Minimum Items </div>
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
                        @foreach ($widget['content']['minimumitems'] as $item)
                            
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->code}}</td>
                            <td>{{$item->min}}</td>
                            <td>{{$item->qty}}</td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                </table>
              
                {{$widget['content']['minimumitems']->appends(array_except(Request::query(), 'minimumitems'))->links();}}

        <!-- /.col-->
    </div>
</div>

@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')