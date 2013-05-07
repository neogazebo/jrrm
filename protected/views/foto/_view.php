<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jaminan_id')); ?>:</b>
	<?php echo CHtml::encode($data->jaminan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('source')); ?>:</b>
	<?php echo CHtml::encode($data->source); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />


</div>