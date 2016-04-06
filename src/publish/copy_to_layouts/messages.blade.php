<?php
$message_types = [
        'success', 'success1', 'success2', 'success3', 'success4', 'success5',
        'error', 'error1', 'error2', 'error3', 'error4', 'error5',
        'info', 'info1', 'info2', 'info3', 'info4', 'info5'
];

$typeColorArray = [
        'success' => 'green-text',
        'error'   => 'red-text',
        'info'    => 'blue-text'
];
?>

{{-- Flash Messages --}}
<div class='row'>
    @foreach ($message_types as $message_type)
        @if(Session::has($message_type))
            <?php $message_type_without_digits = preg_replace('/\d+/', '', $message_type); ?>

            <div class="chip {{ $typeColorArray[$message_type_without_digits] }}">
                <i class="material-icons alert text-lighten-1">check_circle</i>
                {!! Session::get($message_type) !!}
            </div>

        @endif
    @endforeach
</div>

{{-- Requist Messages --}}
@if(count($errors->all()))
    <div class="row">
        @foreach($errors->all() as  $error)
            <div class="chip red-text">
                <i class="material-icons alert text-lighten-1">cancel</i>
                {!! $error !!}
            </div>
        @endforeach
    </div>
    <div class="divider"></div>
    <br>
@endif