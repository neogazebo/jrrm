<?php
$this->breadcrumbs=array(
	'Jaminans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Jaminan','url'=>array('index')),
	array('label'=>'Create Jaminan','url'=>array('create')),
	array('label'=>'Update Jaminan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Jaminan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Jaminan','url'=>array('admin')),
);
?>

<h1>View Jaminan #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'jenis_jaminan_id',
		'propinsi_id',
		'alamat',
		'latitude',
		'longitude',
		'info',
	),
)); ?>
