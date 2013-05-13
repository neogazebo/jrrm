<?php
	$image = CHtml::image(Yii::app()->getBaseUrl().'/slir/w255-h150-c255x150'.Yii::app()->getBaseUrl().'/img_jaminan/'.$data->getThumbnailImage(),'',array('class'=>'thumbnail'));
	$status = $data->status;
	$keterangan_status = ($status == 'laku') ? ucfirst($status) : 'Di'.$status ;
?>

<li class="span3">
	<div class="image_holder">
	<?php echo CHtml::link($image,  Yii::app()->createUrl('jaminan/view', array('id'=>$data->id)),array('rel'=>'tooltip','data-title'=>"View Detail"))?>
	</div>
	<div>
		<p><?php echo $keterangan_status.' '.$data->jenisJaminan->name?><br />Harga&nbsp;Rp <?php echo number_format($data->harga,0,'','.') ?> <br />
			<?php echo $data->kota.', '.$data->propinsi->name ?>
		</p>
	</div>
</li>