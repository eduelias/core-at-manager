<?php

class Mov_extratoController extends Controller
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
				'actions'=>array('admin','delete','index','view','create','update','movimentos','baixajax'),
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
		$model=new mov_extrato;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['mov_extrato']))
		{
			$model->attributes=$_POST['mov_extrato'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idmov_caixa));
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

		if(isset($_POST['mov_extrato']))
		{
			$model->attributes=$_POST['mov_extrato'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idmov_caixa));
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
		$dataProvider=new CActiveDataProvider('mov_extrato');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionBaixajax(){
		
		if (isset($_GET['baixa'])){
			$conn = Yii::app()->db;
			$data = (isset($_GET['data']))?'"'.date('Y-m-d H:i:s', CDateTimeParser::parse($_GET['data'], Yii::app()->locale->dateFormat)).'"':'NOW()';
			$command = $conn->createCommand('UPDATE mov_contas SET data_pgto = '.$data.' WHERE idmov_contas = '.$_GET['idmov_contas']);
			$command->execute();
			echo '{true}';

		}	
	}
		/**
	 * Lists all models.
	 */
	public function actionMovimentos()
	{
		$this->layout = '//layouts/column1';
		
		$mes = (isset($_GET['mes']))?str_pad($_GET['mes'],2,'0',STR_PAD_LEFT):date('m');
		$ano = (isset($_GET['ano']))?$_GET['ano']:date('Y');
		$caixa = (isset($_GET['caixa']))?$_GET['caixa']:2;
		
		$condition = array('condition'=>'EXTRACT(YEAR_MONTH FROM data) = '.$ano.$mes.' AND idccorrentes='.$caixa,'order'=>'data asc'); 
		
		$dataProvider = new CActiveDataProvider('mov_extrato',array('criteria'=>$condition));
		
		$saldo = new CActiveDataProvider('v_saldos',array('criteria'=>$condition));
		
		$contas = new CActiveDataProvider('mov_contas',array('criteria'=>array('condition'=>'data_pgto is null')));
		
		$this->render('movimentos',array(
			'dataProvider'=>$dataProvider,'dp_saldo'=>$saldo,'dp_contas'=>$contas
		));
					
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new mov_extrato('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['mov_extrato']))
			$model->attributes=$_GET['mov_extrato'];

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
				$this->_model=mov_extrato::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='mov-extrato-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
