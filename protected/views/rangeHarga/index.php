<?php
$this->breadcrumbs=array(
	'Range Hargas',
);

$this->menu=array(
	array('label'=>'Create RangeHarga','url'=>array('create')),
	array('label'=>'Manage RangeHarga','url'=>array('admin')),
);
?>

<h1>Range Hargas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
