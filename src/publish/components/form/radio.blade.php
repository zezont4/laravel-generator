<div class="row">
    <div class="radio_rapper col s12">
        <p class="title-font {{$errors->has($name) ? 'validate invalid' : ''}} {{isset($attributes['is_required']) ? 'required' : ''}}" data-error="{{$errors->first($name)}}">{{$label}}</p>
        @foreach ($values as $key => $value)
            <span>
                {{ \Form::radio($name, $key, $key===$selected_value ? true : false,array_merge($attributes,['id'=>$name.$key]))}}
                {{ \Form::label($name.$key, $value.' ') }}
            </span>
        @endforeach
    </div>
</div>