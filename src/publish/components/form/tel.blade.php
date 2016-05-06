<?php
$required = isset($attributes['is_required']) ? ["class" => "required"] : [];
?>
<div class="row">
    <div class="input-field col s12">
        {{ \Form::tel($name, $value, array_merge(['id'=>$name,'placeholder'=>$label,'class' =>  $errors->has($name) ? 'validate invalid' : ''], $attributes)) }}
        {{ \Form::label($name, $label, array_merge($errors->has($name) ? ['data-error' => $errors->first($name)]:[],$required)) }}
    </div>
</div>