<?php
$message_types = [
        'success', 'success1', 'success2', 'success3', 'success4', 'success5',
        'error', 'error1', 'error2', 'error3', 'error4', 'error5',
        'info', 'info1', 'info2', 'info3', 'info4', 'info5'
];

$typeColorArray = [
        'success' => 'green-text text-darken-2 green lighten-4',
        'error'   => 'red-text text-darken-2 red lighten-4',
        'info'    => 'blue-text text-darken-2 blue lighten-4'
];
?>

{{-- Flash Messages --}}
<div class='row'>
    @foreach ($message_types as $message_type)
        @if(Session::has($message_type))
            <?php $message_type_without_digits = preg_replace('/\d+/', '', $message_type); ?>

            <div class="chip {{ $typeColorArray[$message_type_without_digits] }}">
                {{  Session::get($message_type) }}
                <i class="material-icons">close</i>
            </div>

        @endif
    @endforeach
</div>

{{-- Requist Messages --}}
@if(count($errors->all()))
    <div class="row">
        @foreach($errors->all() as  $error)
            <div class="chip red-text text-darken-2 red lighten-4">
                {!! $error !!}
                <i class="material-icons">close</i>
            </div>
        @endforeach
    </div>
    <div class="divider"></div>
    <br>
@endif