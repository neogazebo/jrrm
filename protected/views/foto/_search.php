<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'jaminan_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'source',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'type',array('class'=>'span5','maxlength'=>1)); ?>

	<?php echo $form->textFieldRow($model,'isThumbnail',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
