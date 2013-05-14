<?php
$this->breadcrumbs=array(
	'Jenis Jaminan'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Jenis Jaminan Baru','url'=>array('create')),
);

$this->widget('bootstrap.widgets.TbAlert', array(
	'alerts' => array(
		'success' => array('block' => true, 'fade' => true),
	),
));
?>

<h1>Pengaturan Jenis Jaminan</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'jenis-jaminan-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'name',
			'header'=>'Jenis Jaminan',
			'type'=>'raw',
			'value'=>function($data,$row){
				return CHtml::link($data->name, Yii::app()->createUrl('jenisJaminan/update', array('id'=>$data->id)), array('rel'=>'tooltip','title'=>'Update'));
			}
		),
	),
)); ?>
