<?php

class Mov_contasController extends Controller
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
		
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','index','view','create','update'),
				'users'=>$lev0,
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
		$this->layout = '//layouts/css';
		
		if (isset($_POST['rel_mov_contas_formas_pg'])) {
			
			$parc = new rel_mov_contas_formas_pg;
			$parc->attributes = $_POST['rel_mov_contas_formas_pg'];
			if(!$parc->save()) echo 'NÃO FOI';
		}
		
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}
	/**
	 * Displays a particular model.
	 */
	public function actionManage()
	{
		$model=new rel_mov_contas_formas_pg;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['rel_mov_contas_formas_pg']))
		{
			$model->attributes=$_POST['rel_mov_contas_formas_pg'];
			if($model->save())
				$this->redirect(array('manage','id'=>$model->idmov_contas));
		}

		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new mov_contas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['mov_contas']))
		{
			$model->attributes=$_POST['mov_contas'];
			if($model->save())
				if(isset($_GET['id_proj']))
					$this->redirect(array('projetos/manage','id'=>$_GET['id_proj']));
					else
					$this->redirect(array('view','id'=>$model->idmov_contas));
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
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['mov_contas']))
		{
			$model->attributes=$_POST['mov_contas'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idmov_contas));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
			else
				if($_GET['ajax']=='parcelas') {
					$mod = rel_mov_contas_formas_pg::model()->findbyPk($_GET['id']);
					$mod->delete();
				} else {
					// we only allow deletion via POST request
					$this->loadModel()->delete();
				}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('mov_contas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new mov_contas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['mov_contas']))
			$model->attributes=$_GET['mov_contas'];

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
				$this->_model=mov_contas::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='mov-contas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
