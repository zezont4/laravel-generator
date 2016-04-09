<?php
return [

	'yes_no' => [
		0 => 'لا',
		1 => 'نعم',
	],

	'button' => [
		'save'            => 'حفظ',
		/* inside create page*/
		'create'          => 'إضافة',
		/* inside edit page*/
		'edit'            => 'تعديل',
		/* inside edit page*/
		'delete'          => 'حذف',
		/* inside edit page if the record is deleted*/
		'restore'         => 'استعادة',
		/* the buttons above index table*/
		'new'             => 'جديد',
		'advanced_search' => 'بحث متقدم',

		/* the button inside index table*/
		'search'          => 'بحث',
	],

	'title' => [
		/* these will show as a title in the header after page title like :Users / edit*/
		'show' => 'عرض',
		'create'  => 'جديد',
		'edit' => 'تعديل',
		'search' => 'بحث',
	],

	'message'            => [
		'this_record_is_deleted' => 'هذا السجل محذوف',
		/* message in the index page if there is no records*/
		'no_results'              => 'لا توجد بيانات',

		/*Message in edit or show page if the id is not found*/
		'no_result'              => 'عفوا ... لقد وصلت إلى هذه الصفحة بطريقة غير صحيحة ؟',

	],

	/* <select placeholder="">*/
	'select_placeholder' => 'اختر ...',

	/* If you want Models to be in a separate folder inside app*/
	/* If you write a path , then put a trailing slash "/" at the end*/
	'model_path'         => 'Models/',

	'model_message' => [
		'created'  => 'تمت الإضافة بنجاح',
		'updated'  => 'تم التعديل بنجاح',
		'deleted'  => 'تم الحذف بنجاح',
		'restored' => 'تمت الإستعادة بنجاح',
	],

	/* the sorting arrow in the header of index table*/
	'sorting_arrow' => '<i class="material-icons right grey-text text-darken-1">arrow_drop_up</i>',

	/* Date format in validations */
	'date_format' => 'Y/m/d'
];
