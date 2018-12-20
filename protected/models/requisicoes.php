<?php

/**
 * This is the model class for table "requisicoes".
 *
 * The followings are the available columns in table 'requisicoes':
 * @property integer $idrequisicoes
 * @property integer $idprojetos
 * @property integer $idusuarios
 * @property string $data_sistema
 * @property string $data_previsao
 * @property string $data_termino
 * @property string $prioridade
 */
class requisicoes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return requisicoes the static model class
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
		return 'requisicoes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descr, idprojetos, idusuarios', 'required'),
			array('idrequisicoes, idprojetos, idusuarios', 'numerical', 'integerOnly'=>true),
			array('data_previsao, data_termino', 'length', 'max'=>45),
			array('prioridade', 'length', 'max'=>1),
			array('data_sistema', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idrequisicoes, idprojetos, idusuarios, data_sistema, data_previsao, data_termino, prioridade', 'safe', 'on'=>'search'),
		);
	}
	
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
			'historico' => array(self::HAS_MANY, 'historico', 'idrequisicoes'),
			'projeto' => array(self::BELONGS_TO, 'Projetos', 'idprojetos'),
			'usuario' => array(self::BELONGS_TO, 'Usuarios', 'idusuarios'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idrequisicoes' => 'Idrequisicoes',
			'idprojetos' => 'Idprojetos',
			'idusuarios' => 'Idusuarios',
			'descr' => 'Requisição',
			'data_sistema' => 'Data Sistema',
			'data_previsao' => 'Data Previsao',
			'data_termino' => 'Data Termino',
			'prioridade' => 'Prioridade',
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

		$criteria->compare('idrequisicoes',$this->idrequisicoes);

		$criteria->compare('idprojetos',$this->idprojetos);

		$criteria->compare('idusuarios',$this->idusuarios);

		$criteria->compare('data_sistema',$this->data_sistema,true);

		$criteria->compare('data_previsao',$this->data_previsao,true);
		
		$criteria->compare('descr',$this->descr,true);

		$criteria->compare('data_termino',$this->data_termino,true);

		$criteria->compare('prioridade',$this->prioridade,true);

		return new CActiveDataProvider('requisicoes', array(
			'criteria'=>$criteria,
		));
	}
}