@extends('package_views::layouts.master')
@section('title','الحقول Fields')
@section('header')
    <style>
        input[type=text] {
            height: 1.7rem;
            background-color: rgba(238, 238, 238, 0);
            border: 1px solid #999;
            border-radius: 4px;
            padding: 0 5px 0 0;
            margin: 0;
            width: 90%;
        }

        select.browser-default {
            background-color: rgba(238, 238, 238, 0);
            border: 1px solid #999;
            padding: 0 5px 0 0;
            margin-bottom: 0;
            height: 30px;
        }
    </style>
@stop
@section('content')
    <form method="post" action="/laravel_generator/post_to_session">
        {{ csrf_field() }}
        <div class="row">
            <table class="striped centered">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" name="select_all" id="select_all"/>
                        <label for="select_all">تحديد<br>Select</label>
                    </th>
                    <th>الاسم<br>Name</th>
                    <th>العنوان<br>Label</th>
                    <th>نوع البيانات<br>Type</th>
                    <th>يقبل الفارغ؟<Br>?Allow Null</th>
                    <th>مفتاح؟<br>?Key</th>
                    <th>أخرى<br>Extra</th>
                    <th>نوع الحقل في النموذج<br>Input Type In Form</th>
                    <th>مطلوب؟<br>?Required</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fields as $index => $field)
                    <?php $checked = ($field->Null == 'NO' &&
                            $field->Key != 'PRI' &&
                            $field->Field != 'updated_at' &&
                            $field->Field != 'created_at' &&
                            $field->Field != 'deleted_at') ?>
                    <tr>
                        <td style="text-align: center">
                            <input type="checkbox" name="select[]" id="select_{{$index}}"
                                   value="{{$field->Field}}" {{$checked ? 'checked': ''}} />
                            <label for="select_{{$index}}">&nbsp;</label>
                        </td>
                        <td>
                            <input type="hidden" value="{{$field->Field}}" name="field_name[]">
                            {{$field->Field}}
                        </td>
                        <td>
                            <input type="text" value="{{$field->Comment}}" name="field_comment[]">
                        </td>
                        <td style="direction: ltr">
                            <input type="hidden" value="{{$field->Type}}" name="field_type[]">
                            {{$field->Type}}
                        </td>
                        <td>{{$field->Null}}</td>
                        <td>
                            <input type="hidden" value="{{$field->Key}}" name="key[]">
                            {{$field->Key}}
                        </td>
                        <td>{{$field->Extra}}</td>
                        <td>
                            <select name="input_type[]" class="browser-default">
                                <option value="text" selected>Text</option>
                                <option value="select">Select</option>
                                <option value="radio" {{$field->Type=='tinyint(1)'? 'selected':''}}>Radio</option>
                                <option value="checkbox">Checkbox</option>
                            </select>
                        </td>
                        <td style="text-align: center">
                            <input type="checkbox" name="required[]" id="required_{{$index}}"
                                   {{$checked ? 'checked': ''}} value="{{$field->Field}}"/>
                            <label for="required_{{$index}}">&nbsp;</label>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <button class="btn waves-effect waves-light left red lighten-2" type="submit" name="action">التالي</button>
        </div>
    </form>
@stop

@section('footer')
    <script>
        $(document).ready(function () {
            $("#select_all").change(function () {
                $("input[name='select[]']").prop('checked', $(this).prop("checked"));
            });

            $("input[name='select[]']").change(function () {
                if ($(this).prop('checked') == false) {
                    var required_id = this.id.replace(/select_/i, 'required_');
                    $("#" + required_id).prop('checked', $(this).prop("checked"));
                }
            });
        });
    </script>
@stop