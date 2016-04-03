@if(file_exists(base_path()."/app/{$write_to_path}.php"))
    <div class="chip yellow lighten-1 md-size-font">
        يوجد ملف بنفس الإسم
        <i class="material-icons">close</i>
    </div>
@else
    @if(file_put_contents(base_path()."/app/{$write_to_path}.php", convertTemplateVariables("{$page_name}")))
        <span class="green-text md-size-font">File Created Successfully</span>
    @endif
@endif