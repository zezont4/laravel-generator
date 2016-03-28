<br>
<div class="divider"></div>
<br>

<button class="btn waves-effect waves-light blue lighten-2"
        onclick="selectElementContents(document.getElementById('model_code'))">تحديد الكود
</button>

<pre class="language-php">
    <code class="language-php" id="model_code">
        use \Illuminate\Database\Eloquent\SoftDeletes;
        use Traits\SearchFormHelper;
        use Traits\FlashMessageAfterSaving;

        protected $table = '{{$table_name}}';

        protected $fillable = ['name1', 'name2', 'name3', 'name4', 'gender', 'st_id', 'birth_date', 'neighbor', 'street', 'house_no', 'phone_no', 'father_mobile_no', 'emergency_mobile_no', 'add_transportation', 'accepted_status', 'is_paid', 'updated_at', 'created_at', 'deleted_at', 'is_approved'];

        /*
        * my custom searchable fields that came from search form
        */
        public $searchableFields = ['name1', 'name2', 'name3', 'name4', 'gender', 'st_id', 'birth_date', 'neighbor', 'street', 'house_no', 'phone_no', 'father_mobile_no', 'emergency_mobile_no', 'add_transportation', 'accepted_status', 'is_paid', 'updated_at', 'created_at', 'deleted_at', 'is_approved'];
    </code>
</pre>
<h5 style="direction: ltr" class="header">Copy to "app\Models\{{$model_name}}.php" inside the class.</h5>
