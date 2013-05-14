<?php
$this->breadcrumbs=array(
	'Jenis Jaminan'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Jenis Jaminan','url'=>array('index')),
);
?>

<h1>Jenis Jaminan Baru</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>