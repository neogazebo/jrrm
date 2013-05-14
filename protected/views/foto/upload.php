<?php
$this->breadcrumbs=array(
	'List Jaminan'=>array('jaminan/index'),
	'#'.$jaminan_id=>array('jaminan/view','id'=>$jaminan_id),
	'Update'=>array('jaminan/update','id'=>$jaminan_id),
	'Foto'=>array('index','jaminan_id'=>$jaminan_id),
	'Upload'
);

?>

<?php 
$this->widget('xupload.XUpload', array(
	'url' => Yii::app()->createUrl("/foto/uploadAdditional"),
	'model' => $photos,
	'attribute' => 'file',
	'uploadView' => 'application.views.foto._upload',
	'downloadView' => 'application.views.foto._download',
	'multiple' => false,
	'options' => array(
		'maxFileSize' => 200000,
		'submit' => "js:function (e, data) {
									 var inputs = data.context.find(':input');
									 data.formData = inputs.serializeArray();
									 return true;
									}
								"
	),
//	'formView' => 'form',
		)
);

?>