@includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_start')
<div class="{{ $widget['class'] ?? '' }}">
    {{-- {!! $widget['content'] !!} --}}
    <div class="">
        <div class="">
            <div class="card">
                <div class="card-header"><i class="fa fa-align-justify"></i>Top export </div>
                <div class="card-body">
                    <table class="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Qty Export</th>
                                <th>Date Export</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($widget['content']['topexport'] as $item)

                            <tr>
                                <td>{{$item->item->name}}</td>
                                <td>{{$item->item->code}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{date('Y-m-d',strtotime($item->date))}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>


                    <!-- /.col-->
                </div>
            </div>

            @includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')