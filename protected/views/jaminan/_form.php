<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'jaminan-form',
	'enableAjaxValidation' => false,
		));

?>

<p class="help-block">Kolom dengan <span class="required">*</span> harus diisi</p>

<?php echo $form->errorSummary($model); ?>
<fieldset>
	<legend>Data Jaminan</legend>
	<div class="row">
		<div class="span5">

			<?php echo $form->dropdownListRow($model, 'jenis_jaminan_id', CHtml::listData(JenisJaminan::model()->findAll(), 'id', 'name'), array('class' => 'span5', 'prompt' => 'Pilih Jenis Jaminan')); ?>

			<?php echo $form->textFieldRow($model, 'judul', array('class' => 'span5')); ?>
			
			<?php echo $form->textAreaRow($model, 'info', array('rows' => 6, 'cols' => 50, 'class' => 'span5')); ?>
			
			<?php echo $form->textFieldRow($model, 'harga', array('class' => 'span5','style' => 'text-align:right')); ?>
			
			<?php echo $form->radioButtonListInlineRow($model,'status', array(Jaminan::STAT_JUAL=>ucfirst(Jaminan::STAT_JUAL),Jaminan::STAT_LELANG=>ucfirst(Jaminan::STAT_LELANG),Jaminan::STAT_LAKU=>ucfirst(Jaminan::STAT_LAKU))) ?>
		</div>
		<div class="span5">
			<?php echo $form->labelEx($model, 'propinsi_id') ?>
			<?php
			$this->widget('ext.select2.ESelect2', array(
				'model' => $model,
				'htmlOptions' => array(
					'style' => 'clear: both;display: block;',
					'class' => 'span5 select2',
				),
				'attribute' => 'propinsi_id',
				'data' => CHtml::listData(Propinsi::model()->findAll(), 'id', 'name'),
				'options' => array(
					'placeholder' => "Pilih Propinsi",
				),
			))
			?>

			<?php echo $form->textFieldRow($model, 'kota', array('class' => 'span5', 'maxlength' => 45)); ?>
			
			<?php echo $form->textAreaRow($model, 'alamat', array('rows' => 2, 'cols' => 10, 'class' => 'span5 geomap')); ?>
			
			<?php echo $form->hiddenField($model,'latitude').$form->hiddenField($model,'longitude'); ?>
			
			<?php 
			$this->widget('bootstrap.widgets.TbButton', array(
				'label'=>'Set in map',
				'type'=>'primary',
				'size'=>'mini',
				'buttonType'=>'button',
				'htmlOptions'=>array('id'=>'smap')
			)); 
			?>
			
			<div id="maps" class="" style="height: 400px"></div>
		</div>
	</div>
</fieldset>

<fieldset>
	<legend>Surat Kepemilikan</legend>
	<div class="row">
		<div class="span5 surat_jaminan">
			<?php
				for($i = 0;$i < count($surats) ; $i++)
				{
					$this->renderPartial('_surat',array(
						'surat'=>$surats[$i],
						'index'=>$i,
					));
				}
			?>
		
		</div>
		<div class="span5">
			<?php
			$this->widget('bootstrap.widgets.TbButton', array(
				'buttonType' => 'ajaxButton',
				'type' => 'primary',
				'label' => 'Add',
				'ajaxOptions' => array(
					'method'=>'GET',
					'data'=> 'js:{index:$(".surat_field_counter").length}',
					'success'=>'js:function(response){$(".surat_jaminan").append(response)}'
				),
				'url'=>yii::app()->createUrl('jaminan/fieldSurat')
			)); 
			?>
		</div>
	</div>
</fieldset>

<div class="form-actions">
	<?php
	$this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'submit',
		'type' => 'primary',
		'label' => 'Save',
	));

	?>
</div>

<?php $this->endWidget(); ?>

<?php
$zoom = ($model->getScenario()=='insert') ? '11' : '15';
$url = Yii::app()->createUrl('jaminan/deleteSurat');
$model_id = ($model->id) ? $model->id : 0;
Yii::app()->clientScript->registerCss('img_marker',<<<CSS
  #maps img{
		max-width : none;
 }
CSS
);
Yii::app()->clientScript->registerScriptFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyBoNyuwR7A61dy1QIZ4WB8to6BPIV9HC7Q&sensor=false&language=id');
Yii::app()->clientScript->registerScript('map', "
var map;
var marker;
var geocoder;

function initialize() {
	geocoder = new google.maps.Geocoder();
	var jlat = ($('#Jaminan_latitude').val()) ? $('#Jaminan_latitude').val() : -6.203403;
	var jlong = ($('#Jaminan_longitude').val()) ? $('#Jaminan_longitude').val() : 106.823225;
	
	var latLang = new google.maps.LatLng(jlat, jlong);
  var mapOptions = {
    zoom: $zoom,
    center: latLang,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('maps'),mapOptions);

	marker = new google.maps.Marker({
      position: latLang,
      map:map,
			draggable:true,
  });
	
	google.maps.event.addListener(marker, 'dragend', function() {
		var pos = marker.getPosition();
		$('#Jaminan_latitude').val(pos.lat());
		$('#Jaminan_longitude').val(pos.lng());
		map.setCenter(marker.getPosition());
	});
}


$('#smap').click(function(){
	var objPropinsi = $('#s2id_Jaminan_propinsi_id').select2('data');

	var propinsi = (objPropinsi.text) ? ','+objPropinsi.text : 'Jakarta';
	var kota = ($('#Jaminan_kota').val()) ? ','+$('#Jaminan_kota').val() : '' ;
	var alamat = ($('#Jaminan_alamat').val()) ? ','+$('#Jaminan_alamat').val() : '';
	var address = 'Indonesia'+propinsi+kota+alamat;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
			map.setZoom(15);
      map.setCenter(results[0].geometry.location);
      marker.setPosition(results[0].geometry.location);
			var geoloc = results[0].geometry.location;
			geoloc = geoloc.toString().replace('(','');
			geoloc = geoloc.toString().replace(')','');
			geoloc = geoloc.toString().split(',');
			var lat = $.trim(geoloc[0]);
			var long = $.trim(geoloc[1]);
			$('#Jaminan_latitude').val(lat);
			$('#Jaminan_longitude').val(long);
		}  
  });
});

google.maps.event.addDomListener(window, 'load', initialize);
");
Yii::app()->clientScript->registerScript('delete_field_surat', "
$('body').delegate('.del_field_surat','click',function(){
	var that = $(this);
	var objSurat = that.attr('rel');
	var fieldIndex = that.attr('id');
	var counter = $('.surat_field_counter.count').length-1;
	if(objSurat)
	{
		$.ajax('$url',{
			'data':{id:objSurat,jaminanId:$model_id},
			'success':function(){
				if(counter)
				{		
					$('#SuratKepemilikan_'+fieldIndex+'_name').remove();
					$(that).parent().parent().removeClass('count');
					$(that).remove();
				}
				else
				{
					$('#SuratKepemilikan_'+fieldIndex+'_name').val('');
					$('#SuratKepemilikan_'+fieldIndex+'_id').val('');
				}
			}
		})
	}
	else
	{
		if(counter)
		{		
			$('#SuratKepemilikan_'+fieldIndex+'_name').remove();
			$(that).parent().parent().removeClass('count');
			$(that).remove();
		}
		else
		{
			$('#SuratKepemilikan_'+fieldIndex+'_name').val('');
		}
	}
});
");
?>
