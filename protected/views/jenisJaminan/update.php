<?php
$this->breadcrumbs=array(
	'Jenis Jaminan'=>array('index'),
	'Update',
);

$this->menu=array(
	array('label'=>'Jenis Jaminan Baru','url'=>array('create')),
	array('label'=>'Manage Jenis Jaminan','url'=>array('index')),
);
?>

<h1>Update Jenis Jaminan #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>