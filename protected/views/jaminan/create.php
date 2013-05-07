<?php
$this->breadcrumbs=array(
	'Jaminans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Jaminan','url'=>array('index')),
	array('label'=>'Manage Jaminan','url'=>array('admin')),
);
?>

<h1>Create Jaminan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>