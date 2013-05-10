<div class="surat_field_counter row count">
	<div class="span4">
		<?php
			echo CHtml::activeTextField($surat,"[$index]name",array('class'=>'span4'));
			echo CHtml::activeHiddenField($surat,"[$index]id");
		?>
	</div>
	<div class="span1">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Delete',
			'type'=>'danger',
			'size'=>'mini',
			'buttonType'=>'button',
			'htmlOptions'=>array(
				'class'=>'del_field_surat',
				'rel'=>$surat->id,
				'id'=>$index
			)
	)); ?>
	</div>
	<div style="display: block;clear: both"></div>
</div>