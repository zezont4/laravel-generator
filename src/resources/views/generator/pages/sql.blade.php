<br>
<div class="divider"></div>
<br>

<button class="btn waves-effect waves-light blue lighten-2"
        onclick="selectElementContents(document.getElementById('sql_code'))">تحديد الكود
</button>

<pre class="language-sql">
    <code class="language-sql" id="sql_code">
        ALTER TABLE {{$table_name}}  ADD deleted_at TIMESTAMP NULL DEFAULT NULL;
        ALTER TABLE {{$table_name}}  ADD created_at TIMESTAMP NOT NULL;
        ALTER TABLE {{$table_name}}  ADD updated_at TIMESTAMP NOT NULL;
    </code>
</pre>
<h5 style="direction: ltr" class="header">if you need timestamps then run this in mysql</h5>
