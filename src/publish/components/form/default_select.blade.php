<?php
$required = isset($attributes['is_required']) ? ["class" => "required "] : [];
if (!isset($attributes['class'])) {
    $attributes = array_merge($attributes, ['class' => '']);
}
$attributes['class'] .= $errors->has($name) ? ' validate invalid browser-default' : ' browser-default';
?>
<div class="row">
    <div class="input-field input-field col s12 browser-default">
        {{ \Form::label($name, $label, array_merge($errors->has($name) ? ['data-error' => $errors->first($name)]:[],$required)) }}
        {{ \Form::select($name, $values, $selected_value , array_merge(['placeholder' => 'اختر من القائمة ...'], $attributes))}}
    </div>
</div>
