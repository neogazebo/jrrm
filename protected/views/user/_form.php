<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>20,'autocomplete'=>'off')); ?>

	<?php if($model->getScenario() == 'insert'): ?>
	<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>20,'autocomplete'=>'off')); ?>

	<?php elseif($model->getScenario() == 'update'): ?>
	<?php echo $form->passwordFieldRow($model,'newPassword',array('class'=>'span5','autocomplete'=>'off','maxlength'=>20));	 endif; ?>
	
	<?php echo $form->dropDownListRow($model,'roles',  User::userRolesList()); ?>

	<?php echo $form->textFieldRow($model,'firstname',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'lastname',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
