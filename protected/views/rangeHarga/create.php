<?php
$this->breadcrumbs=array(
	'Range Hargas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RangeHarga','url'=>array('index')),
	array('label'=>'Manage RangeHarga','url'=>array('admin')),
);
?>

<h1>Create RangeHarga</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>