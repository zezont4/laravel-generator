@if(file_exists(base_path("/resources/views/".strtolower(snake_case($model_name))."/{$page}.blade.php")))
    <div class="chip yellow lighten-1 md-size-font">
        يوجد ملف بنفس الإسم
        <i class="material-icons">close</i>
    </div>
@else
    @if(!is_dir(base_path("/resources/views/".strtolower(snake_case($model_name)))))
        <?php mkdir(base_path("/resources/views/" . strtolower(snake_case($model_name))));?>
    @endif
    @if(file_put_contents(base_path("/resources/views/".strtolower(snake_case($model_name))."/{$page}.blade.php"), $text_content))
        <span class="green-text md-size-font">File Created Successfully</span>
    @endif
@endif