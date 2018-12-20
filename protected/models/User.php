<?php

/**
 * This is the model class for table "usuarios".
 *
 * The followings are the available columns in table 'usuarios':
 * @property integer $idusuarios
 * @property integer $idclifor
 * @property string $usuario
 * @property string $senha
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class. 
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idclifor, usuario, senha', 'required'),
			array('idclifor', 'numerical', 'integerOnly'=>true),
			array('usuario, senha', 'length', 'max'=>10),
			array('nivel', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idusuarios, idclifor, usuario, senha', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'documentos' => array(self::HAS_MANY, 'Documentos', 'idusuarios'),
			'historicos' => array(self::HAS_MANY, 'Historico', 'idusuarios'),
			'mov_contases' => array(self::HAS_MANY, 'MovContas', 'idusuarios'),
			'projetoses' => array(self::HAS_MANY, 'Projetos', 'idusuarios'),
			'requisicoes' => array(self::HAS_MANY, 'Requisicoes', 'idusuarios'),
			'idclifor0' => array(self::BELONGS_TO, 'cadastro', 'idclifor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idusuarios' => 'Userid',
			'idclifor' => 'Id',
			'usuario' => 'Login',
			'senha' => 'Senha',
			'nivel' => 'Nivel',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idusuarios',$this->idusuarios);

		$criteria->compare('idclifor',$this->idclifor);

		$criteria->compare('usuario',$this->usuario,true);

		$criteria->compare('senha',$this->senha,true);
		
		$criteria->compare('nivel',$this->senha,true);

		return new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
		));
	}
}