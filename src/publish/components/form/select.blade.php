<div class="row">
    <div class="input-field col s12">
        {{ \Form::select($name, $values, $key==$selected_value ? true : false, array_merge(['class' =>  $errors->has($name) ? 'validate invalid' : '','placeholder' => 'اختر من القائمة ...'], $attributes))}}
        {{ \Form::label($name, $label, $errors->has($name) ? ['data-error' => $errors->first($name)]:null) }}
    </div>
</div>
