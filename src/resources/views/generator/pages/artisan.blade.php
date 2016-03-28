<br>
<div class="divider"></div>
<br>

<button class="btn waves-effect waves-light blue lighten-2"
        onclick="selectElementContents(document.getElementById('artisan_code'))">تحديد الكود
</button>

<pre class="language-bash">
    <code class="language-bash" id="artisan_code">
        php artisan make:model {{$model_name}}
        php artisan make:controller {{$model_name}}Controller
        php artisan make:request {{$model_name}}Request
        composer dump-autoload
    </code>
</pre>
<h5 style="direction: ltr" class="header">run with Mac OS Termenal Or Windows Command prompt "cmd"</h5>
