<?php
$this->breadcrumbs=array(
	'Surat Kepemilikans'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SuratKepemilikan','url'=>array('index')),
	array('label'=>'Create SuratKepemilikan','url'=>array('create')),
	array('label'=>'Update SuratKepemilikan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete SuratKepemilikan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SuratKepemilikan','url'=>array('admin')),
);
?>

<h1>View SuratKepemilikan #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'jaminan_id',
	),
)); ?>
