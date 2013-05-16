<?php
$this->breadcrumbs = array(
	'List Jaminan' => array('index'),
	'#' . $model->id,
);

$this->menu = array(
	array('label' => 'List Jaminan', 'url' => array('index')),
	array('label' => 'Create Jaminan', 'url' => array('create')),
	array('label' => 'Update Jaminan', 'url' => array('update', 'id' => $model->id)),
);

?>

<h1>Jaminan #<?php echo $model->id; ?></h1>

<?php
$data = '<div class="row"><div class="span4">'.$this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'htmlOptions' => array('class' => 'detail-jaminan'),
	'attributes' => array(
		array(
			'name' => 'status',
			'type' => 'raw',
			'value' => ucfirst($model->status)
		),
		array(
			'name' => 'harga',
			'type' => 'raw',
			'value' => 'Rp ' . number_format($model->harga, 0, '', '.')
		),
		array(
			'name' => 'jenis_jaminan_id',
			'type' => 'raw',
			'value' => $model->jenisJaminan->name
		),
		array(
			'name' => 'propinsi_id',
			'type' => 'raw',
			'value' => $model->propinsi->name
		),
		'kecamatan',
		'kelurahan',
		'alamat',
	),
),true).'</div><div class="span6">'.CHtml::image(Yii::app()->getBaseUrl() . '/slir/w550-h300-c550x300' . Yii::app()->getBaseUrl() . '/img_jaminan/' . $model->getThumbnailImage(), '', array('class' => 'thumbnail')).'</div></div>';

$this->widget('bootstrap.widgets.TbTabs', array(
	'type' => 'tabs',
	'events'=>array(
		'shown' => "js:function(){
									geocoder = new google.maps.Geocoder();
									var jlat = $model->latitude;
									var jlong = $model->longitude;

									var latLang = new google.maps.LatLng(jlat, jlong);
									var mapOptions = {
										zoom: 11,
										center: latLang,
										mapTypeId: google.maps.MapTypeId.ROADMAP
									};
									map = new google.maps.Map(document.getElementById('map'),mapOptions);

									marker = new google.maps.Marker({
											position: latLang,
											map:map,
									});
								}"
	),
	'tabs' => array(
		array
		(
			'label' => 'Informasi',
			'content' => $data,
			'active' => true
		),
		array(
			'label' => 'Peta',
			'content' => '<div class="row"><div class="span10"><div id="map" style="height: 300px"></div></div></div>'
		)
	),
));

?>
<div class="row">
	<div class="span10">
		<strong>DESKRIPSI</strong>
		<p><?php echo (CHtml::encode($model->info)) ? CHtml::encode($model->info) : 'Tidak ada deskripsi' ?></p>
	</div>
</div>

<div class="row">
	<div class="span6">
		<?php if (count($foto_depan) >= 1): ?>
			<strong>FOTO DEPAN</strong>
			<?php
			$this->widget('bootstrap.widgets.TbCarousel', array(
				'items' => $foto_depan
			));

			?>
<?php endif; ?>
	</div>
</div>

<div class="row">
	<div class="span6">
		<?php if (count($foto_dalam) >= 1): ?>
			<strong>FOTO DALAM</strong>
	<?php
	$this->widget('bootstrap.widgets.TbCarousel', array(
		'items' => $foto_dalam
	));

	?>
		<?php endif; ?>
	</div>
</div>

<div class="row">
	<div class="span6">
<?php if (count($foto_lainnya) >= 1): ?>
			<strong>FOTO LAINNYA</strong>
	<?php
	$this->widget('bootstrap.widgets.TbCarousel', array(
		'items' => $foto_lainnya
	));

	?>
<?php endif; ?>
	</div>
</div>
<?php
Yii::app()->clientScript->registerCss('img_marker', <<<CSS
  #maps img{
		max-width : none;
 }
CSS
);
Yii::app()->clientScript->registerScriptFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyBoNyuwR7A61dy1QIZ4WB8to6BPIV9HC7Q&sensor=false');
?>
