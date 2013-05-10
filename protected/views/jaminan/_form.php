<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'jaminan-form',
	'enableAjaxValidation' => false,
		));

?>

<p class="help-block">Kolom dengan <span class="required">*</span> harus diisi</p>

<?php echo $form->errorSummary($model); ?>
<fieldset>
	<legend>Data Jaminan</legend>
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
		</div>
	</div>
</fieldset>
<fieldset>
	<legend>Surat Kepemilikan</legend>
	<div class="row">
		<div class="span5 surat_jaminan">
			<?php
				for($i = 0;$i < count($surats) ; $i++)
				{
					$this->renderPartial('_surat',array(
						'surat'=>$surats[$i],
						'index'=>$i,
					));
				}
			?>
		
		</div>
		<div class="span5">
			<?php
			$this->widget('bootstrap.widgets.TbButton', array(
				'buttonType' => 'ajaxButton',
				'type' => 'primary',
				'label' => 'Add',
				'ajaxOptions' => array(
					'method'=>'GET',
					'data'=> 'js:{index:$(".surat_field_counter").length}',
					'success'=>'js:function(response){$(".surat_jaminan").append(response)}'
				),
				'url'=>yii::app()->createUrl('jaminan/fieldSurat')
			)); 
			?>
		</div>
	</div>
</fieldset>

<div class="form-actions">
	<?php
	$this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'submit',
		'type' => 'primary',
		'label' => 'Save',
	));

	?>
</div>

<?php $this->endWidget(); ?>

<?php
$url = Yii::app()->createUrl('jaminan/deleteSurat');
$model_id = ($model->id) ? $model->id : 0;
Yii::app()->clientScript->registerScript('delete_field_surat', "
$('body').delegate('.del_field_surat','click',function(){
	var that = $(this);
	var objSurat = that.attr('rel');
	var fieldIndex = that.attr('id');
	var counter = $('.surat_field_counter.count').length-1;
	if(objSurat)
	{
		$.ajax('$url',{
			'data':{id:objSurat,jaminanId:$model_id},
			'success':function(){
				if(counter)
				{		
					$('#SuratKepemilikan_'+fieldIndex+'_name').remove();
					$(that).parent().parent().removeClass('count');
					$(that).remove();
				}
				else
				{
					$('#SuratKepemilikan_'+fieldIndex+'_name').val('');
					$('#SuratKepemilikan_'+fieldIndex+'_id').val('');
				}
			}
		})
	}
	else
	{
		if(counter)
		{		
			$('#SuratKepemilikan_'+fieldIndex+'_name').remove();
			$(that).parent().parent().removeClass('count');
			$(that).remove();
		}
		else
		{
			$('#SuratKepemilikan_'+fieldIndex+'_name').val('');
		}
	}
});
");
?>
