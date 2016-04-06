@if(count($trashed))
    <div class="clearfix">
        <hr>
        <div class="accordion" id="accordion2">
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                        <p>يوجد عدد {{count($trashed)}} نتائج محذوفة</p>
                    </a>
                </div>
                <div id="collapseOne" class="accordion-body collapse">

                    <div class="accordion-inner">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                @foreach($data as $label => $dbFieldName)
                                    <th>{{ $label  }}</th>
                                @endforeach
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            @foreach($trashed as $deleted)
                                <tr>
                                    @foreach($data as $label => $dbFieldName)
                                        <td>{{ $deleted->$dbFieldName  }}</td>
                                    @endforeach
                                    <td><a href="{!! route(strtolower($modelName).'.edit',  [strtolower($modelName).'_id_wt' => $deleted->id] ) !!}">تعديل</a></td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endif