<?php
$this->breadcrumbs=array(
	'Fotos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Foto','url'=>array('index')),
	array('label'=>'Manage Foto','url'=>array('admin')),
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