<?php
$this->breadcrumbs=array(
	'My Profile'
);

$this->menu=array(
	array('label'=>'Update Profile','url'=>array('update','id'=>$model->id)),
);
?>

<h1>My Profile</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'firstname',
		'lastname',
	),
)); ?>
