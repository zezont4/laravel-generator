<br>
<div class = "divider"></div>
<br>

<button class = "btn waves-effect waves-light blue lighten-2"
        onclick = "selectElementContents(document.getElementById('{{$id}}_code'))">تحديد الكود
</button>

<pre class = "language-{{$language}}">
    <code class = "language-{{$language}}}" id = "{{$id}}_code">
        {{convertVariables("$url")}}
    </code>
</pre>
<h5 style = "direction: ltr" class = "header">{{$description}}</h5>