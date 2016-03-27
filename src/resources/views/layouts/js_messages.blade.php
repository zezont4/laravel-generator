<?php
$danger = ['danger', 'danger01', 'danger02', 'danger03', 'danger04', 'danger05', 'danger99'];
$warning = ['warning', 'warning01', 'warning02', 'warning03', 'warning04', 'warning05', 'warning99'];
$success = ['success', 'success01', 'success02', 'success03', 'success04', 'success05', 'success99'];
$info = ['info', 'info01', 'info02', 'info03', 'info04', 'info05', 'info99'];
$msgs = array_merge($danger, $warning, $success, $info);
?>

@foreach ($msgs as $msg)
    @if(Session::has($msg))
        {!!  "<script>
                myAlert('".Session::get($msg)."','". preg_replace('/\d+/','',$msg)."');
        </script>"
        !!}

    @endif
@endforeach