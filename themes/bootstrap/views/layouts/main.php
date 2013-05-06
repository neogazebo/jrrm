<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
		
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

		<title><?php echo CHtml::encode($this->pageTitle); ?></title>

		<?php Yii::app()->bootstrap->register(); ?>
	</head>

	<body>

		<?php
		$user = Yii::app()->user;
		$this->widget('bootstrap.widgets.TbNavbar', array(
			'collapse' => true,
			'type' => 'inverse',
			'items' => array(
				array(
					'class' => 'bootstrap.widgets.TbMenu',
					'items' => array(
						array('label' => 'About', 'url' => array('/site/page', 'view' => 'about'), 'visible' => Yii::app()->user->isGuest),
						array('label' => 'Contact', 'url' => array('/site/contact'), 'visible' => Yii::app()->user->isGuest),
						array('label' => 'User Management', 'url' => array('/user/'), 'visible' => !Yii::app()->user->isGuest),
					),
				),
				array(
					'class' => 'bootstrap.widgets.TbMenu',
					'htmlOptions' => array('class' => 'pull-right'),
					'items' => array(
						array('label' => ucfirst(Yii::app()->user->name), 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest,'items'=>array(
							array('label' => 'Profile', 'url' => array('/profile/'), 'visible' => !Yii::app()->user->isGuest),
							array('label' => 'Logout', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
						))
					),
				),
			),
		));

		?>

		<div class="container" id="page">

			<?php if (isset($this->breadcrumbs)): ?>
				<?php
				$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
					'links' => $this->breadcrumbs,
				));

				?><!-- breadcrumbs -->
			<?php endif ?>

			<?php echo $content; ?>

			<div class="clear"></div>

			<div id="footer">
				Copyright &copy; <?php echo date('Y'); ?> BNI<br/>
				All Rights Reserved.<br/>
			</div><!-- footer -->

		</div><!-- page -->

	</body>
</html>
