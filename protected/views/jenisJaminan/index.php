<?php
$this->breadcrumbs=array(
	'Jenis Jaminans',
);

$this->menu=array(
	array('label'=>'Create JenisJaminan','url'=>array('create')),
	array('label'=>'Manage JenisJaminan','url'=>array('admin')),
);
?>

<h1>Jenis Jaminans</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
