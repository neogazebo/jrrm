<?php

return array(
	'components' => array(
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=jrrm',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'febri123',
			'charset' => 'utf8',
		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'admin@bni.com',
	),
);
