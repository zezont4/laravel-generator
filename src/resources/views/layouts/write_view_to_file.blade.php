
@if(file_exists(base_path()."/resources/views/".strtolower($model_name)."/{$page}.blade.php"))
    <span class="alert yellow lighten-1 md-size-font">File already exists. for protection, copy it manually</span>
@else
    @if(file_put_contents(base_path()."/resources/views/".strtolower($model_name)."/{$page}.blade.php", $text_content))
        <span class="green-text md-size-font">File Created Successfully</span>
    @endif
@endif