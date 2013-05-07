<?php
$this->breadcrumbs=array(
	'Jaminans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Jaminan','url'=>array('index')),
	array('label'=>'Create Jaminan','url'=>array('create')),
	array('label'=>'View Jaminan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Jaminan','url'=>array('admin')),
);
?>

<h1>Update Jaminan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>