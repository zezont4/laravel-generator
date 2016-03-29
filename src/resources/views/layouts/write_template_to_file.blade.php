
@if(file_exists(base_path()."/app/{$write_to_path}.php"))
    <span class="alert yellow lighten-1 md-size-font">File already exists. for protection, copy it manually</span>
@else
    @if(file_put_contents(base_path()."/app/{$write_to_path}.php", convertVariables("{$page_name}")))
        <span class="green-text md-size-font">File Created Successfully</span>
    @endif
@endif