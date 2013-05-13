<?php

class JaminanController extends Controller
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array('admin', 'delete','fieldSurat','create', 'update','deleteSurat'),
				'users' => array('@'),
			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$foto_depan = $model->getAllFotoByType('D');
		$foto_dalam = $model->getAllFotoByType('I');
		$foto_lainnya = $model->getAllFotoByType('L');
	
		$this->render('view', array(
			'model' => $model,
			'foto_depan'=>$foto_depan,
			'foto_dalam'=>$foto_dalam,
			'foto_lainnya'=>$foto_lainnya,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Jaminan;
		$surats[] = new SuratKepemilikan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Jaminan']))
		{
			$model->attributes = $_POST['Jaminan'];
			if ($model->save())
			{
				$POSTSurats = $_POST['SuratKepemilikan'];
				foreach ($POSTSurats as $surat)
				{
					$objSurat = new SuratKepemilikan;
					$objSurat->attributes = $surat;
					$objSurat->jaminan_id = $model->id;
					$objSurat->save();
				}
				Yii::app()->user->setFlash('success', 'Jaminan Baru Telah di input');
				$this->redirect(array('update', 'id' => $model->id));
			}
		}

		$this->render('create', array(
			'model' => $model,
			'surats' => $surats
		));
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

		$surats = $model->suratKepemilikan;
		if (empty($surats))
			$surats[] = new SuratKepemilikan;

		if (isset($_POST['Jaminan']))
		{
			$model->attributes = $_POST['Jaminan'];
			if ($model->save())
			{
				$POSTSurats = $_POST['SuratKepemilikan'];
				foreach ($POSTSurats as $surat)
				{
					$objSurat = (empty($surat['id'])) ? new SuratKepemilikan : SuratKepemilikan::model()->findByPk($surat['id']);
					$objSurat->attributes = $surat;
					$objSurat->jaminan_id = $model->id;
					$objSurat->save();
				}
				Yii::app()->user->setFlash('success', 'Informasi jaminan #'.$model->id.' telah di perbarui');
				$this->redirect(array('update', 'id' => $model->id));
			}
		}

		$this->render('update', array(
			'model' => $model,
			'surats' => $surats
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
	public function actionIndex()
	{
		$this->layout = '//layouts/column1';
		$dataProvider = new CActiveDataProvider('Jaminan');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
			'pagination'=>array(
        'pageSize'=>1,
			),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Jaminan('search');
		$model->unsetAttributes();	// clear any default values
		if (isset($_GET['Jaminan']))
			$model->attributes = $_GET['Jaminan'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = Jaminan::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	public function actionFieldSurat($index)
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			$surat = new SuratKepemilikan;
			$this->renderPartial('_surat', array(
				'surat' => $surat,
				'index' => $index
			),false,true);
		}
		else
			throw new CHttpException(404, 'The requested page does not exist.');
	}
	
	public function actionDeleteSurat($id,$jaminanId)
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			$surat = SuratKepemilikan::model()->findByPk($id);
			if($surat)
			{
				$surat->delete();
			}
		}
		else
			throw new CHttpException(404, 'The requested page does not exist.');
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'jaminan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
