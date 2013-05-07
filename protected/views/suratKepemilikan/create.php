<?php
$this->breadcrumbs=array(
	'Surat Kepemilikans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SuratKepemilikan','url'=>array('index')),
	array('label'=>'Manage SuratKepemilikan','url'=>array('admin')),
);
?>

<h1>Create SuratKepemilikan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>