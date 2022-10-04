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

                            @foreach ($widget['content']['topexport'] as $top)
                            @if ($top->item != null)
                            <tr>
                                <td>{{$top->item->name}}</td>
                                <td>{{$top->item->code}}</td>
                                <td>{{$top->qty}}</td>
                                <td>{{date('Y-m-d',strtotime($top->date))}}</td>
                            </tr>
                            @endif

                            @endforeach


                        </tbody>
                    </table>


                    <!-- /.col-->
                </div>
            </div>

            @includeWhen(!empty($widget['wrapper']), 'backpack::widgets.inc.wrapper_end')