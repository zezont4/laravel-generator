<div class="row">
    <div class="input-field col s12">
        <button
                class="btn waves-effect waves-light {{ $class }}"
                type="submit"
                name="action"
        @isset($attributes)
            @foreach($attributes as $key =>$val)
                {{$key}} = "{{$val}}"
            @endforeach
        @endisset
        >
        {{$label}}
        </button>
    </div>
</div>
