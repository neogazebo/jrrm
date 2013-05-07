<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'jenis_jaminan_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'propinsi_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'alamat',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'latitude',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'longitude',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textAreaRow($model,'info',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
