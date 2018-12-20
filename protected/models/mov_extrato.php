<?php

/**
 * This is the model class for table "mov_extrato".
 *
 * The followings are the available columns in table 'mov_extrato':
 * @property integer $idmov_caixa
 * @property integer $idrel_mov_contas
 * @property integer $idccorrentes
 * @property string $operacao
 * @property string $documento
 * @property string $data
 * @property string $valor
 * @property string $data_sistema
 */
class mov_extrato extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return mov_extrato the static model class
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
		return 'mov_extrato';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idrel_mov_contas, idccorrentes, documento', 'required'),
			array('idrel_mov_contas, idccorrentes', 'numerical', 'integerOnly'=>true),
			array('documento', 'length', 'max'=>30),
			array('valor', 'length', 'max'=>9),
			array('data', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idmov_caixa, idrel_mov_contas, idccorrentes, operacao, documento, data, valor, data_sistema', 'safe', 'on'=>'search'),
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
					$this->$columnName = ($this->$columnName == '31/12/1969 21:00:00')?'  ':$this->$columnName; 
					$aux = explode(' ',$this->$columnName);
					$this->$columnName = ($aux[1] == '00:00:00')?$aux[0]:$this->$columnName;				                              
				}elseif ($column->dbType == 'timestamp'){                                
					$this->$columnName = Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($this->$columnName, 'yyyy-MM-dd hh:mm:ss'));
					$this->$columnName = ($this->$columnName == '31/12/1969 00:00:00')?'':$this->$columnName;                        
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
			'cc' => array(self::BELONGS_TO, 'ccorrentes', 'idccorrentes'),
			'parcela' => array(self::BELONGS_TO, 'rel_mov_contas_formas_pg', 'idrel_mov_contas'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idmov_caixa' => 'Idmov Caixa',
			'idrel_mov_contas' => 'Idrel Mov Contas',
			'idccorrentes' => 'Idccorrentes',
			'operacao' => 'Operacao',
			'documento' => 'Documento',
			'data' => 'Data',
			'valor' => 'Valor',
			'data_sistema' => 'Data Sistema',
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

		$criteria->compare('idmov_caixa',$this->idmov_caixa);

		$criteria->compare('idrel_mov_contas',$this->idrel_mov_contas);

		$criteria->compare('idccorrentes',$this->idccorrentes);

		$criteria->compare('operacao',$this->operacao,true);

		$criteria->compare('documento',$this->documento,true);

		$criteria->compare('data',$this->data,true);

		$criteria->compare('valor',$this->valor,true);

		$criteria->compare('data_sistema',$this->data_sistema,true);

		return new CActiveDataProvider('mov_extrato', array(
			'criteria'=>$criteria,
		));
	}
}