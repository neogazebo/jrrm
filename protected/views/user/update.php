<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage User','url'=>array('index')),
);
?>

<h1>Update <?php echo ucfirst($model->username); ?>'s Data</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>