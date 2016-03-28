<div class="row">
    <div class="radio_rapper col s12">
        <p class="title-font {{$errors->has($name) ? 'validate invalid' : ''}}" data-error="{{$errors->first($name)}}">{{$label}}</p>
        @foreach ($values as $key => $value)
            <p>
                {{ \Form::radio($name, $key, null,['id'=>$name.$key])}}
                {{ \Form::label($name.$key, $value) }}

            </p>
        @endforeach
    </div>
</div>