<?php
$this->breadcrumbs=array(
	'Fotos',
);

$this->menu=array(
	array('label'=>'Create Foto','url'=>array('create')),
	array('label'=>'Manage Foto','url'=>array('admin')),
);
?>

<h1>Fotos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
