<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'foto-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'jaminan_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'source',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'type',array('class'=>'span5','maxlength'=>1)); ?>

	<?php echo $form->textFieldRow($model,'isThumbnail',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
