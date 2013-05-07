<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'jaminan-form',
	'enableAjaxValidation' => false,
		));

?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'jenis_jaminan_id', array('class' => 'span5')); ?>

<?php echo $form->labelEx($model,'propinsi_id') ?>
<?php
$this->widget('ext.select2.ESelect2', array(
	'model' => $model,
	'htmlOptions' => array(
		'style' => 'clear: both;display: block;width:365px'
	),
	'attribute' => 'propinsi_id',
	'data' => CHtml::listData(Propinsi::model()->findAll(), 'id','name'),
	'options'=>array(
		'placeholder'=>"Pilih Propinsi",
	),
))
?>
<div style="clear: both;display: block"></div>
<?php echo $form->textFieldRow($model, 'alamat', array('class' => 'span5', 'maxlength' => 200)); ?>

<?php echo $form->textFieldRow($model, 'latitude', array('class' => 'span5', 'maxlength' => 45)); ?>

	<?php echo $form->textFieldRow($model, 'longitude', array('class' => 'span5', 'maxlength' => 45)); ?>

	<?php echo $form->textAreaRow($model, 'info', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

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
