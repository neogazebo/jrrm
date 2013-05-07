<?php
$this->breadcrumbs=array(
	'Range Hargas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RangeHarga','url'=>array('index')),
	array('label'=>'Create RangeHarga','url'=>array('create')),
	array('label'=>'View RangeHarga','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage RangeHarga','url'=>array('admin')),
);
?>

<h1>Update RangeHarga <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>