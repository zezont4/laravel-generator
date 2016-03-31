<br>
<div class="divider"></div>
<br>
<?php
$generateLanguagePage = generateLanguagePage();

$materialize_show = generateMaterializeShowPage($model_name, $table_label, session('primary_key'));
$materialize_form = generateMaterializeFormPage();
$materialize_create = generateMaterializeCreatePage($model_name, $table_label);
$materialize_edit = generateMaterializeEditPage($model_name, $table_label, session('primary_key'));
$materialize_index = generateMaterializeIndexPage($model_name, $table_label, session('primary_key'));
$materialize_search = generateMaterializeSearchPage($model_name, $table_label);
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
                @include('package_views::layouts.write_view_to_file',['text_content'=>$materialize_search])
            @elseif($page == 'index')
                @include('package_views::layouts.write_view_to_file',['text_content'=>$materialize_index])
            @endif
        @endif

    </div>

    <div class="col s4 m5">
        <h5 class="left header">
            @if($page == 'language')
                {{$page.'.php'}}
            @else
                {{$page.'.blade.php'}}
            @endif
        </h5>
    </div>

</div>

<div class="row remove-margin-bottom">
    <pre class="language-php">
        <code class="language-php" id="{{$page}}_code">

            @if($page == 'language')
                {{$generateLanguagePage}}
            @elseif($page == 'create')
                {{$materialize_create}}
            @elseif($page == '_form')
                {{$materialize_form}}
            @elseif($page == 'edit')
                {{$materialize_edit}}
            @elseif($page == 'show')
                {{$materialize_show}}
            @elseif($page == 'search')
                {{$materialize_search}}
            @elseif($page == 'index')
                {{$materialize_index}}
            @endif


        </code>
    </pre>
</div>

<h6 style="direction: ltr" class="grey-text">
    @if($page == 'language')
        Copy to <strong>resources\lang\ar\validation.php</strong>
    @else
        Copy to <strong>resources\views\{{strtolower($model_name)}}\{{$page}} .blade.php</strong>
    @endif
</h6>