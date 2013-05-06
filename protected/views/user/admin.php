<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create User','url'=>array('create')),
);
?>

<h1>Manage Users</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'username',
			'type' => 'raw',
			'value' => function($data,$row){
				return CHtml::link($data->username, Yii::app()->createUrl('user/update',array('id'=>$data->id)), array('rel'=>'tooltip','title'=>'Update'));
			},
		),
		array(
			'name' => 'roles',
			'value' => '$data->roles',
			'filter' => array(User::ROLE_VIEWER => 'Viewer',User::ROLE_DATAENTRY => 'Data Entry',User::ROLE_SUPERVISOR => 'Supervisor')
		),
		'firstname',
		'lastname',
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
	),
)); ?>
