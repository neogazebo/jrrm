<?php
$this->breadcrumbs=array(
	'My Profile'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'View Profile','url'=>array('index')),
);
?>

<h1>Update My Profile</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>