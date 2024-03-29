<?php
$this->breadcrumbs=array(
	'List Jaminan'=>array('jaminan/index'),
	'#'.$jaminan_id=>array('jaminan/view','id'=>$jaminan_id),
	'Update'=>array('jaminan/update','id'=>$jaminan_id),
	'Foto'
);

$that = $this;
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
				$images = ($data->source) ? $data->source : 'default.jpg';
				return CHtml::link(CHtml::image(Yii::app()->getBaseUrl() . "/img_jaminan/".$images,'',array('height'=>'80','width'=>'80')),  Yii::app()->createUrl('foto/upload', array('jaminan_id'=>$jaminan_id,'id'=>$data->id)),array('rel'=>'tooltip','title'=>'Upload'));
			}
		),
		array(
			'name'=>'isThumbnail',
			'htmlOptions' => array('style' => 'text-align:right;width:86%'),
			'type'=>'raw',
			'value'=>  function ($data,$row)use($jaminan_id){
				return ($data->isThumbnail) ? CHtml::link('Thumbnail', Yii::app()->createUrl('foto/setThumbnail',array('id'=>$data->id,'jaminan_id' => $jaminan_id)), array('class'=>'btn btn-success btn-mini')) : CHtml::link('Set as thumb', Yii::app()->createUrl('foto/setThumbnail',array('id'=>$data->id,'jaminan_id' => $jaminan_id)), array('class'=>'btn btn-info btn-mini')) ;
			}
		),
		array(
			'htmlOptions' => array('style' => 'text-align:right'),
			'type'=>'raw',
			'value'=>function($data,$row)use($jaminan_id){
				return CHtml::link('Remove', Yii::app()->createUrl('foto/delete',array('id'=>$data->id,'jaminan_id'=>$jaminan_id)),array('class'=>'btn btn-warning btn-mini'));
			}
		),
	),
)); ?>
</fieldset>
<?php endforeach; ?>
