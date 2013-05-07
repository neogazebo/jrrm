<?php
$this->breadcrumbs=array(
	'Fotos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Foto','url'=>array('index')),
	array('label'=>'Manage Foto','url'=>array('admin')),
);
?>

<h1>Create Foto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>