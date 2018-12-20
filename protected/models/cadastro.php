<?php

/**
 * This is the model class for table "clifor".
 *
 * The followings are the available columns in table 'clifor':
 * @property integer $idclifor
 * @property string $nome
 * @property string $cnpj_cpf
 * @property string $email
 * @property string $endereco
 * @property string $telefone
 * @property string $cidade
 * @property string $uf
 */
class cadastro extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return cadastro the static model class
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
		return 'clifor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('idclifor, nome, cnpj_cpf, email', 'required'),
			array('idclifor', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>100),
			array('cnpj_cpf', 'length', 'max'=>15),
			array('email, cidade, uf', 'length', 'max'=>45),
			array('endereco', 'length', 'max'=>255),
			array('telefone', 'length', 'max'=>14),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idclifor, nome, cnpj_cpf, email, endereco, telefone, cidade, uf', 'safe', 'on'=>'search'),
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
			'projetos' => array(self::MANY_MANY, 'Projetos', 'rel_projetos_clifor(idprojetos, idclifor)'),
			'usuarios' => array(self::HAS_MANY, 'User', 'idclifor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idclifor' => 'ID',
			'nome' => 'Nome',
			'cnpj_cpf' => 'Documento',
			'email' => 'Email',
			'endereco' => 'Endereco',
			'telefone' => 'Telefone',
			'cidade' => 'Cidade',
			'uf' => 'UF',
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

		$criteria->compare('idclifor',$this->idclifor);

		$criteria->compare('nome',$this->nome,true);

		$criteria->compare('cnpj_cpf',$this->cnpj_cpf,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('endereco',$this->endereco,true);

		$criteria->compare('telefone',$this->telefone,true);

		$criteria->compare('cidade',$this->cidade,true);

		$criteria->compare('uf',$this->uf,true);

		return new CActiveDataProvider('cadastro', array(
			'criteria'=>$criteria,
		));
	}
}