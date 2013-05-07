<?php
$this->breadcrumbs=array(
	'Jenis Jaminans'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List JenisJaminan','url'=>array('index')),
	array('label'=>'Create JenisJaminan','url'=>array('create')),
	array('label'=>'Update JenisJaminan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete JenisJaminan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JenisJaminan','url'=>array('admin')),
);
?>

<h1>View JenisJaminan #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
