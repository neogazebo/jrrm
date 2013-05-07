<?php
$this->breadcrumbs=array(
	'Surat Kepemilikans',
);

$this->menu=array(
	array('label'=>'Create SuratKepemilikan','url'=>array('create')),
	array('label'=>'Manage SuratKepemilikan','url'=>array('admin')),
);
?>

<h1>Surat Kepemilikans</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
