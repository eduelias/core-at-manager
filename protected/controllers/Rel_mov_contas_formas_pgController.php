<?php

class Rel_mov_contas_formas_pgController extends Controller
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
				'actions'=>array('admin','delete','index','view','create','update','baixa','baixaajax'),
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
		$model=new rel_mov_contas_formas_pg;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['rel_mov_contas_formas_pg']))
		{
			$model->attributes=$_POST['rel_mov_contas_formas_pg'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idrel_mov_contas));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Paga.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionBaixa()
	{
		
		$model = rel_mov_contas_formas_pg::model()->find(array('condition'=>'data_pgto is null'));

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($mov_ex);

		$this->render('baixa',array(
			'model'=>$model,
		));
	}
	
		/**
	 * Cria um pagamento via ajax.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionBaixaajax()
	{
		$this->layout = '//layouts/column1';
		
		$mov_ex = new mov_extrato;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($mov_ex);

		if(isset($_GET['mov']))
		{
			$mov_ex->attributes=$_GET['mov'];
			if ($mov_ex->save()) echo '{true}'; else echo '{false}';
			
			Yii::app()->end();
		}
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

		if(isset($_POST['rel_mov_contas_formas_pg']))
		{
			
			$model->attributes=$_POST['rel_mov_contas_formas_pg'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idrel_mov_contas));
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
			// we only allow deletion via POST request
			$this->loadModel()->delete();

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
		$dataProvider=new CActiveDataProvider('rel_mov_contas_formas_pg');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new rel_mov_contas_formas_pg('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['rel_mov_contas_formas_pg']))
			$model->attributes=$_GET['rel_mov_contas_formas_pg'];

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
				$this->_model=rel_mov_contas_formas_pg::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='rel-mov-contas-formas-pg-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
