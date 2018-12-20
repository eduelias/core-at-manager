<?php

class ProjetosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

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
		$model0 = User::model()->findbyAttributes(array('nivel'=>0));
		
		if (is_array($model0)) {
			foreach ($model0 as $reg) { 
				$lev0[] = $reg->usuario;				
			}
		} else {
			$lev0 = array($model0->usuario);
		}
		
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','manage'),
				'users'=>$lev0
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}
	
	public function actionManage()
	{
		$this->layout = '//layouts/column1';
		$this->render('manage',array(
			'projeto'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new projetos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['projetos']))
		{
			$model->attributes=$_POST['projetos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idprojetos));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		if (isset($_GET['id']['idclifor'])){
			$model = rel_projetos_clifor::model()->find(array('idclifor'=>$_GET['id']['idclifor']));
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
	
			if(isset($_POST['rel_projetos_clifor']))
			{
				$model->attributes=$_POST['rel_projetos_clifor'];
				if($model->save()) {
					echo 'EU'; 
					$this->redirect(array('projetos/manage','id'=>$model->idprojetos));
				} else {
					echo 'não deu';
				}
			} else {
				$this->layout = '//layouts/column1';
				$this->render('/rel_projetos_clifor/update_projeto',array(
					'model'=>$model,
				));
			}
		} else {
			$model=$this->loadModel();
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
	
			if(isset($_POST['projetos']))
			{
				$model->attributes=$_POST['projetos'];
				if($model->save())
					$this->redirect(array('view','id'=>$model->idprojetos));
			}
	
			$this->render('update',array(
				'model'=>$model,
			));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			
			if(is_array($_GET['id'])) {
				
				rel_projetos_clifor::model()->findbyAttributes(array('idclifor'=>$_GET['id']['idclifor'],'idprojetos'=>$_GET['id']['idprojetos']))->delete();
				
			} else {
			// we only allow deletion via POST request
				$this->loadModel()->delete();
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('projetos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new projetos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['projetos']))
			$model->attributes=$_GET['projetos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=projetos::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='projetos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
