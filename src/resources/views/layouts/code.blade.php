<br>
<div class="divider"></div>
<br>

<div class="row remove-margin-bottom">

    <div class="col s8 m7">
        <button class="btn waves-effect waves-light blue lighten-2"
                onclick="selectElementContents(document.getElementById('{{$id}}_code'))">تحديد الكود
        </button>
        @if(\Request::has('_token'))
            @if(@$write_to_path)
                @include('package_views::layouts.write_template_to_file')
            @endif
        @endif

    </div>

    <div class="col s4 m5">
        <h5 class="left header">{{ucwords(str_replace("_", " ",$id))}}</h5>
    </div>

</div>
<div class="row remove-margin-bottom">
    <pre class="language-{{$language}}">
        <code class="language-{{$language}}" id="{{$id}}_code">
            {{convertVariables($page_name)}}
        </code>
    </pre>
</div>

<h6 style="direction: ltr" class="grey-text">{{$description}}</h6>