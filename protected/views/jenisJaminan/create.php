<?php
$this->breadcrumbs=array(
	'Jenis Jaminans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JenisJaminan','url'=>array('index')),
	array('label'=>'Manage JenisJaminan','url'=>array('admin')),
);
?>

<h1>Create JenisJaminan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>