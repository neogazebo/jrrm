<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'jaminan-form',
	'enableAjaxValidation' => false,
		));

?>

<p class="help-block">Kolom dengan <span class="required">*</span> harus diisi</p>

<?php echo $form->errorSummary($model); ?>

<div class="row">
	<div class="span5">

		<?php echo $form->dropdownListRow($model, 'jenis_jaminan_id', CHtml::listData(JenisJaminan::model()->findAll(), 'id', 'name'), array('class' => 'span5', 'prompt' => 'Pilih Jenis Jaminan')); ?>
		
		<?php echo $form->textFieldRow($model, 'harga', array('class' => 'span5','style' => 'text-align:right')); ?>

		<?php echo $form->textAreaRow($model, 'info', array('rows' => 6, 'cols' => 50, 'class' => 'span5')); ?>
	</div>
	<div class="span5">
		<?php echo $form->textAreaRow($model, 'alamat', array('rows' => 6, 'cols' => 30, 'class' => 'span5')); ?>

		<?php echo $form->textFieldRow($model, 'kelurahan', array('class' => 'span5', 'maxlength' => 45)); ?>

		<?php echo $form->textFieldRow($model, 'kecamatan', array('class' => 'span5', 'maxlength' => 45)); ?>

		<?php echo $form->textFieldRow($model, 'kota', array('class' => 'span5', 'maxlength' => 45)); ?>

		<?php echo $form->labelEx($model, 'propinsi_id') ?>
		<?php
		$this->widget('ext.select2.ESelect2', array(
			'model' => $model,
			'htmlOptions' => array(
				'style' => 'clear: both;display: block;',
				'class' => 'span5 select2',
			),
			'attribute' => 'propinsi_id',
			'data' => CHtml::listData(Propinsi::model()->findAll(), 'id', 'name'),
			'options' => array(
				'placeholder' => "Pilih Propinsi",
			),
		))
		?>

		<?php // echo $form->textFieldRow($model, 'latitude', array('class' => 'span5', 'maxlength' => 45)); ?>

		<?php // echo $form->textFieldRow($model, 'longitude', array('class' => 'span5', 'maxlength' => 45)); ?>
	</div>
</div>

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
