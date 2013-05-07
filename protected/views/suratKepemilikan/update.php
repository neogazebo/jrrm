<?php
$this->breadcrumbs=array(
	'Surat Kepemilikans'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SuratKepemilikan','url'=>array('index')),
	array('label'=>'Create SuratKepemilikan','url'=>array('create')),
	array('label'=>'View SuratKepemilikan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage SuratKepemilikan','url'=>array('admin')),
);
?>

<h1>Update SuratKepemilikan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>