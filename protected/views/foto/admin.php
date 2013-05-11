<?php
$this->breadcrumbs=array(
	'Fotos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Foto','url'=>array('index')),
	array('label'=>'Create Foto','url'=>array('create')),
);
?>

<h1>Foto foto Jaminan #<?php echo $jaminan_id ?></h1>

<?php $types = array(Foto::TYPE_DALAM => 'Dalam', Foto::TYPE_DEPAN => 'Depan', Foto::TYPE_LAINNYA => 'Lainnya') ?>
<?php foreach ($types as $type => $val): ?>
<fieldset>
	<h4><?php echo $val ?></h4>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'foto-grid',
	'hideHeader'=>true,
	'htmlOptions'=>array('style'=>'padding-top:0'),
	'dataProvider'=>$model->search($type),
	'summaryText' => '',
	'columns'=>array(
		array(
			'name' => 'source',
			'type' => 'raw',
			'value' => function($data,$row) use($jaminan_id){
				return CHtml::link('gbr',  Yii::app()->createUrl('foto/upload', array('jaminan_id'=>$jaminan_id,'id'=>$data->id)),array('rel'=>'tooltip','title'=>'Upload'));
			}
		),
		array(
			'name'=>'isThumbnail',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</fieldset>
<?php endforeach; ?>
