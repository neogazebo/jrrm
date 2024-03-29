<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
return CMap::mergeArray(require(dirname(__FILE__) . '/common.php'), array(
			'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
			'name' => 'Informasi Jaminan Divisi RRM',
			// preloading 'log' component
			'preload' => array('log'),
			// autoloading model and component classes
			'import' => array(
				'application.models.*',
				'application.components.*',
				'application.extensions.phpass.*',
			),
			'aliases' => array(
				'xupload' => 'ext.xupload'
			),
			'theme' => 'bootstrap',
			'modules' => array(
				// uncomment the following to enable the Gii tool
				'gii' => array(
					'generatorPaths' => array(
						'bootstrap.gii',
					),
					'class' => 'system.gii.GiiModule',
					'password' => 'pass',
					// If removed, Gii defaults to localhost only. Edit carefully to taste.
					'ipFilters' => array('127.0.0.1', '::1'),
				),
			),
			// application components
			'components' => array(
				'hasher' => array(
					'class' => 'Phpass',
					'hashPortable' => false,
					'hashCostLog2' => 10,
				),
				'bootstrap' => array(
					'class' => 'bootstrap.components.Bootstrap',
				),
				'user' => array(
					// enable cookie-based authentication
					'allowAutoLogin' => true,
					'class' => 'FWebUser',
				),
				// uncomment the following to enable URLs in path-format
				
				  'urlManager'=>array(
				  'urlFormat'=>'path',
				  'rules'=>array(
					'peta'=>'site/map',
					'foto/jaminan/<jaminan_id:\d+>'=>'foto/index',
					'foto/jaminan/<jaminan_id:\d+>/upload/<id:\d+>'=>'foto/upload',
				  '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				  '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				  '<controller:\w+>/<action:\w+>'=>'<controller>/<action>'
				  ),
				  ),
				'errorHandler' => array(
					// use 'site/error' action to display errors
					'errorAction' => 'site/error',
				),
				'log' => array(
					'class' => 'CLogRouter',
					'routes' => array(
						array(
							'class' => 'CFileLogRoute',
							'levels' => 'error, warning',
						),
					// uncomment the following to show log messages on web pages
					/*
					  array(
					  'class'=>'CWebLogRoute',
					  ),
					 */
					),
				),
			),
		));