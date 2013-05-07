<?php
$this->breadcrumbs=array(
	'Fotos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Foto','url'=>array('index')),
	array('label'=>'Create Foto','url'=>array('create')),
	array('label'=>'View Foto','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Foto','url'=>array('admin')),
);
?>

<h1>Update Foto <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>