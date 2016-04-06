<div class="row">
    <div class="input-field col s12">
        {{ \Form::tel($name, $value, array_merge(['id'=>$name,'placeholder'=>$label,'class' =>  $errors->has($name) ? 'validate invalid' : ''], $attributes)) }}
        {{ \Form::label($name, $label, ['data-error' => $errors->first($name)]) }}
    </div>
</div>