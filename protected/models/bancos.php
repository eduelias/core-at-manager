<?php

/**
 * This is the model class for table "bancos".
 *
 * The followings are the available columns in table 'bancos':
 * @property integer $idbancos
 * @property string $nome
 * @property string $saldo_inicial
 * @property string $saldo_atual
 * @property string $agencia
 * @property string $ccorrente
 */
class bancos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return bancos the static model class
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
		return 'bancos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idbancos', 'numerical', 'integerOnly'=>true),
			array('nome, agencia, ccorrente', 'length', 'max'=>45),
			array('saldo_inicial, saldo_atual', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idbancos, nome, saldo_inicial, saldo_atual, agencia, ccorrente', 'safe', 'on'=>'search'),
		);
	}
   		//BEFORE SAVE: Alternando as datas do formato i18n para BD
        protected function beforeSave(){        
			foreach($this->metadata->tableSchema->columns as $columnName => $column){                
				if ($column->dbType == 'date'){                        
					$this->$columnName = date('Y-m-d', CDateTimeParser::parse($this->$columnName, Yii::app()->locale->dateFormat));                
				}elseif ($column->dbType == 'datetime'){
					$this->$columnName = date('Y-m-d H:i:s', CDateTimeParser::parse($this->$columnName, Yii::app()->locale->dateFormat));                
				}elseif ($column->dbType == 'timestamp'){
					$this->$columnName = null;                
				}				               
			}                
			return true;
		}        
		
        //AFTER FIND: alterando datas do BD para i18n
		protected function afterFind(){                                                        
			foreach($this->metadata->tableSchema->columns as $columnName => $column){                                        
				if (!strlen($this->$columnName)) continue;                                        
				if ($column->dbType == 'date'){                                                 
					$this->$columnName = Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($this->$columnName, 'yyyy-MM-dd'),'medium',null);                
					$this->$columnName = ($this->$columnName == '31/12/1969')?'':$this->$columnName;
				}elseif ($column->dbType == 'datetime'){                                
					$this->$columnName = Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($this->$columnName, 'yyyy-MM-dd hh:mm:ss')); 
					$this->$columnName = ($this->$columnName == '31/12/1969')?'':$this->$columnName;                              
				}elseif ($column->dbType == 'timestamp'){                                
					$this->$columnName = Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($this->$columnName, 'yyyy-MM-dd hh:mm:ss'));
					$this->$columnName = ($this->$columnName == '31/12/1969')?'':$this->$columnName;                        
				} 
			}        
			return true;
		}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'mov_extratos' => array(self::HAS_MANY, 'MovExtrato', 'idbancos'),
			'rel_bancos_contas' => array(self::HAS_ONE, 'RelBancosContas', 'idbancos'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idbancos' => 'Idbancos',
			'nome' => 'Nome',
			'saldo_inicial' => 'Saldo Inicial',
			'saldo_atual' => 'Saldo Atual',
			'agencia' => 'Agencia',
			'ccorrente' => 'Ccorrente',
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

		$criteria->compare('idbancos',$this->idbancos);

		$criteria->compare('nome',$this->nome,true);

		$criteria->compare('saldo_inicial',$this->saldo_inicial,true);

		$criteria->compare('saldo_atual',$this->saldo_atual,true);

		$criteria->compare('agencia',$this->agencia,true);

		$criteria->compare('ccorrente',$this->ccorrente,true);

		return new CActiveDataProvider('bancos', array(
			'criteria'=>$criteria,
		));
	}
}