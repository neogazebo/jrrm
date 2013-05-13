<?php
$this->breadcrumbs=array(
	'List Jaminan',
);
?>

<h1>List Jaminan</h1>

<?php $this->widget('bootstrap.widgets.TbThumbnails',array(
    'dataProvider'=>$dataProvider,
    'template'=>"{items}{pager}",
    'itemView'=>'_view',
		'enablePagination' => true,
)); ?>

<div style="display: block;clear: both"></div>