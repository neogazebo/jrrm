<?php
$this->breadcrumbs=array(
	'Jaminans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Jaminan','url'=>array('index')),
	array('label'=>'Create Jaminan','url'=>array('create')),
);

?>

<h1>Daftar Jaminan</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'jaminan-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'sJenisJaminan',
			'value' => '$data->jenisJaminan->name'
		),
		array(
			'name' => 'status',
			'value' => 'ucfirst($data->status)'
		),
		array(
			'name' => 'isApproved',
			'filter' => array(0=>'Not Approve',1=>'Approved'),
			'value' => function($data,$row){
				return ($data->isApproved) ? 'Approved' : 'Not Approve';
			}
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
