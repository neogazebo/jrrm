<?php
$this->breadcrumbs=array(
	'List Jaminan'=>array('index'),
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
			'type' => 'raw',
			'value' => function($data,$row){
				return CHtml::link('#'.$data->id, Yii::app()->createUrl('jaminan/update',array('id'=>$data->id)), array('rel'=>'tooltip','title'=>'Update'));
			},
			'htmlOptions' => array('style' => 'width: 50px'),
		),
		array(
			'filter'=>  CHtml::listData(JenisJaminan::model()->findAll(), 'id', 'name'),
			'name' => 'jenis_jaminan_id',
			'value' => '$data->jenisJaminan->name'
		),
		array(
			'filter' => array(Jaminan::STAT_JUAL=>ucfirst(Jaminan::STAT_JUAL),Jaminan::STAT_LELANG=>ucfirst(Jaminan::STAT_LELANG),Jaminan::STAT_LAKU=>ucfirst(Jaminan::STAT_LAKU)),
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
			'template' => '{delete}'
		),
	),
)); ?>
