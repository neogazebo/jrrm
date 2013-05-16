<?php
$this->breadcrumbs=array(
	'List Jaminan'=>array('index'),
	'#'.$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Lihat Jaminan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Jaminan Baru','url'=>array('create')),
	array('label'=>'Manage Jaminan','url'=>array('admin')),
	array('label'=>'Photo','url'=>array('foto/index','jaminan_id'=>$model->id))
);

$this->widget('bootstrap.widgets.TbAlert', array(
	'alerts' => array(
		'success' => array('block' => true, 'fade' => true),
	),
));
?>

<h1>Jaminan #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'surats' => $surats)); ?>