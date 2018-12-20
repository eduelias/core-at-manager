<?php

/**
 * This is the model class for table "rel_mov_contas_formas_pg".
 *
 * The followings are the available columns in table 'rel_mov_contas_formas_pg':
 * @property integer $idrel_mov_contas
 * @property integer $idmov_contas
 * @property integer $idformas_pg
 * @property string $valor
 */
class rel_mov_contas_formas_pg extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return rel_mov_contas_formas_pg the static model class
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
		return 'rel_mov_contas_formas_pg';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idmov_contas, idformas_pg, idccorrentes', 'required'),
			array('idmov_contas, idccorrentes, idformas_pg', 'numerical', 'integerOnly'=>true),
			array('valor', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idrel_mov_contas, idmov_contas, idformas_pg, idccorrentes, valor, recibo, data_pgto', 'safe', 'on'=>'search'),
		);
	}
   		//BEFORE SAVE: Alternando as datas do formato i18n para BD
        protected function beforeSave(){        
			foreach($this->metadata->tableSchema->columns as $columnName => $column){                
				if ($column->dbType == 'date'){                        
					$this->$columnName = date('Y-m-d', CDateTimeParser::parse($this->$columnName, Yii::app()->locale->dateFormat));                
					$this->$columnName = ($this->$columnName == '1969-12-31')?null:$this->$columnName;    
				}elseif ($column->dbType == 'datetime'){
					$this->$columnName = date('Y-m-d H:i:s', CDateTimeParser::parse($this->$columnName, Yii::app()->locale->dateFormat));                
					$this->$columnName = ($this->$columnName == '1969-12-31 21:00:00')?null:$this->$columnName;    
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
			'mov_extrato' => array(self::HAS_MANY, 'mov_extrato', 'idrel_mov_contas'),
			'ccorrentes' => array(self::BELONGS_TO, 'ccorrentes', 'idccorrentes'),
			'parcelas' => array(self::BELONGS_TO, 'formas_pg', 'idformas_pg'),
			'mov_contas' => array(self::BELONGS_TO, 'mov_contas', 'idmov_contas'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idrel_mov_contas' => 'Idrel Mov Contas',
			'idmov_contas' => 'Idmov Contas',
			'idformas_pg' => 'Forma',
			'idccorrentes' => 'Conta',
			'valor' => 'Valor', 
			'data_pgto' => 'Pago',
			'recibo'=>'Recibo'
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
 
		$criteria->compare('idrel_mov_contas',$this->idrel_mov_contas);

		$criteria->compare('idmov_contas',$this->idmov_contas);

		$criteria->compare('idformas_pg',$this->idformas_pg);

		$criteria->compare('valor',$this->valor,true);
		
		$criteria->compare('recibo',$this->recibo, true);

		return new CActiveDataProvider('rel_mov_contas_formas_pg', array(
			'criteria'=>array('condition'=>'data_pgto is null'),
		));
	}
}