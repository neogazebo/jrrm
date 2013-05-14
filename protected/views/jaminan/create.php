<?php
$this->breadcrumbs=array(
	'List Jaminan'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Jaminan','url'=>array('index')),
	array('label'=>'Manage Jaminan','url'=>array('admin')),
);
?>

<h1>Input Jaminan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'surats'=>$surats)); ?>