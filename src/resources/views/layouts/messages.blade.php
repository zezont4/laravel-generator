<?php
/*
$danger = ['danger', 'danger01', 'danger02', 'danger03', 'danger04', 'danger05', 'danger99'];
$warning = ['warning', 'warning01', 'warning02', 'warning03', 'warning04', 'warning05', 'warning99'];
$success = ['success', 'success01', 'success02', 'success03', 'success04', 'success05', 'success99'];
$info = ['info', 'info01', 'info02', 'info03', 'info04', 'info05', 'info99'];
$msgs = array_merge($danger, $warning, $success, $info);
 */
?>

{{--
@foreach ($msgs as $msg)
    @if(Session::has($msg))
        <div class="alert alert-{{ preg_replace('/\d+/','',$msg) }}" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get($msg) }}
        </div>
    @endif
@endforeach
--}}

{{--رسائل الخطأ--}}
@if(isset($errors))
    @if(method_exists($errors, 'all'))
        @if(count($errors->all()))
            <div class="section">
                @foreach($errors->all() as  $error)
                    <p class="red-text text-lighten-2"> {!!$error!!} </p>
                @endforeach
            </div>
            <div class="divider"></div>
        @endif
    @endif
@endif

{{--Flash messages--}}
@if(session()->has('success'))
    <h5 class="green-text center-align"> {{ session('success') }} </h5>
@endif

@if(session()->has('info'))
    <h5 class="yellow-text text-darken-2 center-align"> {{ session('info') }} </h5>
@endif

