<br>
<div class="divider"></div>
<br>
<?php
$materialize_show = generateMaterializeShowPage($fields_array, $model_name, $table_label);
$materialize_form = generateMaterializeFormPage($fields_array, $model_name, $table_label);
$materialize_create = generateMaterializeCreatePage($model_name, $table_label);
$materialize_edit = generateMaterializeEditPage($model_name, $table_label,session('primary_key'));
?>

<div class="row remove-margin-bottom">

    <div class="col s8 m7">
        <button class="btn waves-effect waves-light blue lighten-2"
                onclick="selectElementContents(document.getElementById('{{$page}}_code'))">تحديد الكود
        </button>
        @if(\Request::has('_token'))
            @if($page == 'create')
                @include('package_views::layouts.write_view_to_file',['text_content'=>$materialize_create])
            @elseif($page == '_form')
                @include('package_views::layouts.write_view_to_file',['text_content'=>$materialize_form])
            @elseif($page == 'edit')
                @include('package_views::layouts.write_view_to_file',['text_content'=>$materialize_edit])
            @elseif($page == 'show')
                @include('package_views::layouts.write_view_to_file',['text_content'=>$materialize_show])
            @elseif($page == 'search')
            @elseif($page == 'index')
            @endif
        @endif

    </div>

    <div class="col s4 m5">
        <h5 class="left header">{{$page.'.blade.php'}}</h5>
    </div>

</div>

<div class="row remove-margin-bottom">
    <pre class="language-php">
        <code class="language-php" id="{{$page}}_code">

            @if($page == 'create')
                {{$materialize_create}}
            @elseif($page == '_form')
                {{$materialize_form}}
            @elseif($page == 'edit')
                {{$materialize_edit}}
            @elseif($page == 'show')
                {{$materialize_show}}
            @elseif($page == 'search')
            @elseif($page == 'index')

            @endif


        </code>
    </pre>
</div>

<h6 style="direction: ltr" class="grey-text">Copy to <strong>resources\views\{{strtolower($model_name)}}\{{$page}}
        .blade.php</strong></h6>