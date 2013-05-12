<?php

class FotoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow all users to perform 'index' and 'view' actions
				'actions' => array('index', 'view'),
				'users' => array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('create', 'update', 'upload', 'uploadAdditional','setThumbnail'),
				'users' => array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array('admin', 'delete'),
				'users' => array('admin'),
			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	public function actions()
	{
		return array(
			'upload' => array(
				'class' => 'xupload.actions.XUploadAction',
				'path' => Yii::app()->getBasePath() . "/../uploads",
				'publicPath' => Yii::app()->getBaseUrl() . "/uploads",
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	/**
	 * Upload foto
	 */
	public function actionUpload($jaminan_id, $id)
	{
		$model = $this->loadModel($id);

		$photos = new XUploadForm;

		$jaminan = Jaminan::model()->findByPk($jaminan_id);
		if (!($jaminan instanceof Jaminan))
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$model->jaminan_id = $jaminan_id;
		if (isset($_POST['Foto']))
		{
			$model->attributes = $_POST['Foto'];
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				//Save the model to the database
				if ($model->save())
				{
					$transaction->commit();
				}
			}
			catch (Exception $e)
			{
				$transaction->rollback();
				Yii::app()->handleException($e);
			}
		}

		$this->render('upload', array(
			'model' => $model,
			'photos' => $photos
		));
	}

	public function actionUploadAdditional()
	{
		header('Vary: Accept');
		if (isset($_SERVER['HTTP_ACCEPT']) && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false))
		{
			header('Content-type: application/json');
		}
		else
		{
			header('Content-type: text/plain');
		}

		if (isset($_GET["_method"]))
		{
			if ($_GET["_method"] == "delete")
			{
				$model = Foto::model()->findByPk($_GET['model_id']);
				$model->source = '';
				$model->save(FALSE);
				$success = is_file($_GET["file"]) && $_GET["file"][0] !== '.' && unlink($_GET["file"]);
				echo json_encode($success);
			}
		}
		else
		{
			$upload = new XUploadForm; //Here we instantiate our model
			//We get the uploaded instance
			$upload->file = CUploadedFile::getInstance($upload, 'file');
			if ($upload->file !== null)
			{
				$upload->mime_type = $upload->file->getType();
				$upload->size = $upload->file->getSize();
				$upload->name = $upload->file->getName();
				
				$model_id = Yii::app()->request->getPost('id','');
				$model = Foto::model()->findByPk($model_id);

				if ($upload->validate() && ($model instanceof Foto))
				{
					$path = Yii::app()->getBasePath() . "/../img_jaminan/";
					$publicPath = Yii::app()->getBaseUrl() . "/img_jaminan/";
					if (!is_dir($path))
					{
						mkdir($path, 0777, true);
						chmod($path, 0777);
					}
					$filename = md5( Yii::app( )->user->id.microtime( ).$upload->name);
					$filename .= ".".$upload->file->getExtensionName( );
					$is_uploaded = $upload->file->saveAs($path . $filename);
					if($is_uploaded){
						$model->source = $filename;
						$model->save(false);
					}
					chmod($path . $filename, 0777);

					//Now we return our json
					echo json_encode(array(array(
							"name" => $upload->name,
							"type" => $upload->mime_type,
							"size" => $upload->size,
							"url" => $publicPath . $filename,
							"thumbnail_url" => $publicPath . $filename,
							"delete_url" => $this->createUrl("uploadAdditional", array(
								"_method" => "delete",
								"file" => $path . $filename,
								"model_id"=> $model->id
							)),
							"delete_type" => "POST"
							)));
				}
				else
				{
					echo json_encode(array(array("error" => $upload->getErrors('file'),)));
					Yii::log("XUploadAction: " . CVarDumper::dumpAsString($upload->getErrors()), CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction");
				}
			}
			else
			{
				throw new CHttpException(500, "Could not upload file");
			}
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Foto']))
		{
			$model->attributes = $_POST['Foto'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}

		$this->render('update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($jaminan_id)
	{
		$objJaminan = Jaminan::model()->findByPk($jaminan_id);
		if (!($objJaminan instanceof Jaminan))
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');

		$model = new Foto('search');
		$model->unsetAttributes(); // clear any default values

		$model->jaminan_id = $jaminan_id;

		if (isset($_GET['Foto']))
			$model->attributes = $_GET['Foto'];

		$this->render('admin', array(
			'model' => $model,
			'jaminan_id' => $jaminan_id
		));
	}
	
	public function actionSetThumbnail($id,$jaminan_id)
	{
		$fotos = Foto::model()->findAll();
		foreach ($fotos as $foto)
		{
			$foto->isThumbnail = 0;
			$foto->save(false);
		}
		
		$thumbFoto = Foto::model()->findByPk($id);
		$thumbFoto->isThumbnail = 1;
		$thumbFoto->save(false);
		$this->redirect(array('index','jaminan_id'=>$jaminan_id));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = Foto::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'foto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
