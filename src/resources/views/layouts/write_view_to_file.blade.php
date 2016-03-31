@if(file_exists(base_path()."/resources/views/".strtolower($model_name)."/{$page}.blade.php"))
    <div class="chip yellow lighten-1 md-size-font">
        يوجد ملف بنفس الإسم
        <i class="material-icons">close</i>
    </div>
@else
    @if(!is_dir(base_path()."/resources/views/".strtolower($model_name)))
        @if(mkdir(base_path()."/resources/views/".strtolower($model_name)))
        @endif
    @endif
    @if(file_put_contents(base_path()."/resources/views/".strtolower($model_name)."/{$page}.blade.php", $text_content))
        <span class = "green-text md-size-font">File Created Successfully</span>
    @endif
@endif