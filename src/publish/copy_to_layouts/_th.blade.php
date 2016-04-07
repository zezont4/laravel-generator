<th>
    <a href="{{route($model.'.index', request()->except('sort') + ['sort' => $field]) }}">
        {!! request('sort')==$field ? $arrow : ''!!}{{ MyTrans($field)}}
    </a>
</th>