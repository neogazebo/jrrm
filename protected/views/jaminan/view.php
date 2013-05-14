<?php
$this->breadcrumbs=array(
	'List Jaminan'=>array('index'),
	'#'.$model->id,
);

$this->menu=array(
	array('label'=>'List Jaminan','url'=>array('index')),
	array('label'=>'Create Jaminan','url'=>array('create')),
	array('label'=>'Update Jaminan','url'=>array('update','id'=>$model->id)),
);
?>

<h1>Jaminan #<?php echo $model->id; ?></h1>
<div class="row">
	<div class="span4">
		<?php $this->widget('bootstrap.widgets.TbDetailView',array(
			'data'=>$model,
			'htmlOptions'=>array('class'=>'detail-jaminan'),
			'attributes'=>array(
				array(
					'name'=>'status',
					'type'=>'raw',
					'value'=>ucfirst($model->status)
				),
				array(
					'name'=>'harga',
					'type'=>'raw',
					'value'=>'Rp '.number_format($model->harga,0,'','.')
				),
				array(
					'name'=>'jenis_jaminan_id',
					'type'=>'raw',
					'value'=>$model->jenisJaminan->name
				),
				array(
					'name'=>'propinsi_id',
					'type'=>'raw',
					'value'=>$model->propinsi->name
				),
				'kecamatan',
				'kelurahan',
				'alamat',
			),
		)); ?>
	</div>
	<div class="span6">
		<?php echo CHtml::image(Yii::app()->getBaseUrl().'/slir/w550-h300-c550x300'.Yii::app()->getBaseUrl().'/img_jaminan/'.$model->getThumbnailImage(),'',array('class'=>'thumbnail')); ?>
	</div>
</div>
<div class="row">
	<div class="span10">
		<strong>DESKRIPSI</strong>
		<p><?php echo (CHtml::encode($model->info))? CHtml::encode($model->info):'Tidak ada deskripsi' ?></p>
	</div>
</div>

<div class="row">
	<div class="span6">
		<?php if(count($foto_depan)>=1): ?>
		<strong>FOTO DEPAN</strong>
		<?php $this->widget('bootstrap.widgets.TbCarousel', array(
			'items'=>$foto_depan
		)); ?>
		<?php endif; ?>
	</div>
</div>

<div class="row">
	<div class="span6">
		<?php if(count($foto_dalam)>=1): ?>
		<strong>FOTO DALAM</strong>
		<?php $this->widget('bootstrap.widgets.TbCarousel', array(
			'items'=>$foto_dalam
		)); ?>
		<?php endif; ?>
	</div>
</div>

<div class="row">
	<div class="span6">
		<?php if(count($foto_lainnya)>=1): ?>
		<strong>FOTO LAINNYA</strong>
		<?php $this->widget('bootstrap.widgets.TbCarousel', array(
			'items'=>$foto_lainnya
		)); ?>
		<?php endif; ?>
	</div>
</div>

