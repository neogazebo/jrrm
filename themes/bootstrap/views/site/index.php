<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$user = Yii::app()->user;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>CHtml::encode(Yii::app()->name),
)); ?>

<p>Congratulations</p>
<?php $this->endWidget(); ?>

<h3>Dasboard Page</h3>

<p></p>