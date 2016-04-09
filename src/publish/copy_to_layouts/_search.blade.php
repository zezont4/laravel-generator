<?php $add_container = true; ?>
@foreach(\Illuminate\Support\Facades\Input::all() as $param => $value)
    @if($value && in_array($param,(app("\\App\\".str_replace('/','\\',config('zlg.model_path')).$model)->searchableFields)))
        @if($add_container)
            {!! '<div class="row col s12">' !!}
            <h5 class='title-font grey-text darken-1'>عرض النتائج حسب التالي : </h5>
            <?php $add_container = false; ?>
        @endif
        <div class='chip'><span class='title-font'>{{myTrans($param)}}</span> : {{$value}}</div>

    @endif
@endforeach
@if(! $add_container)
    {!! '</div>' !!}
@endif

<div id='search_modal' class='modal modal-fixed-footer'>
    <div class='modal-content'>
        <div class='section'>
            {{ Form::open(['route' => strtolower($model).'.index', 'method' => 'get']) }}

            @include(strtolower($model).'._form',['btnLabel' => 'بحث','formType' => 'search'])

            {{ Form::close() }}
        </div>
    </div>
</div>