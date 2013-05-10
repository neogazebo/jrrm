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
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'foto-form',
	'enableAjaxValidation' => false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
		));

?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->hiddenField($model, 'jaminan_id') ?>

<?php $model->type = 'D'; echo $form->textFieldRow($model, 'type', array('class' => 'span2', 'maxlength' => 1));

?>

<?php
$this->widget('xupload.XUpload', array(
	'url' => Yii::app()->createUrl("/foto/upload"),
	//our XUploadForm
	'model' => $photos,
	//We set this for the widget to be able to target our own form
	'htmlOptions' => array('id' => 'foto-form'),
	'attribute' => 'file',
	'multiple' => false,
	'options' => array(
		'maxFileSize' => 1
	),
	//Note that we are using a custom view for our widget
	//Thats becase the default widget includes the 'form' 
	//which we don't want here
	'formView' => 'application.views.foto._form',
		)
);

?>

<div class="form-actions">
	<?php
	$this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'submit',
		'type' => 'primary',
		'label' => $model->isNewRecord ? 'Create' : 'Save',
	));

	?>
</div>

<?php $this->endWidget(); ?>
