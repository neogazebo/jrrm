<?php
$this->breadcrumbs=array(
	'Jaminans',
);

$this->menu=array(
	array('label'=>'Create Jaminan','url'=>array('create')),
	array('label'=>'Manage Jaminan','url'=>array('admin')),
);
?>

<h1>Jaminans</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>