<?php
$this->breadcrumbs=array(
	'Range Hargas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RangeHarga','url'=>array('index')),
	array('label'=>'Create RangeHarga','url'=>array('create')),
	array('label'=>'Update RangeHarga','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete RangeHarga','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RangeHarga','url'=>array('admin')),
);
?>

<h1>View RangeHarga #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'min',
		'max',
	),
)); ?>
