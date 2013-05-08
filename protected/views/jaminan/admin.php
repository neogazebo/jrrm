<?php
$this->breadcrumbs=array(
	'Jaminan'=>array('index'),
	'Manajemen',
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
			'name' => 'id',
			'value' => '"#".$data->id',
			'htmlOptions' => array('style' => 'width: 50px'),
		),
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
			'filter' => array(0=>'Draft',1=>'Published'),
			'value' => function($data,$row){
				return ($data->isApproved) ? 'Published' : 'Draft';
			}
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
