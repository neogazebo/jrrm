<?php
$this->breadcrumbs=array(
	'Propinsis'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Propinsi','url'=>array('index')),
	array('label'=>'Create Propinsi','url'=>array('create')),
	array('label'=>'View Propinsi','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Propinsi','url'=>array('admin')),
);
?>

<h1>Update Propinsi <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>