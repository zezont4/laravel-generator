<?php
$required = isset($attributes['is_required']) ? ["class" => "required"] : [];
?>
<div class="row">
    <div class="input-field col s12">
        {{ \Form::select($name, $values, $selected_value , array_merge(['class' =>  $errors->has($name) ? 'validate invalid' : '','placeholder' => 'اختر من القائمة ...'], $attributes))}}
        {{ \Form::label($name, $label, array_merge($errors->has($name) ? ['data-error' => $errors->first($name)]:[],$required)) }}
    </div>
</div>
