<?php

/**
 * This is the model class for table "historico".
 *
 * The followings are the available columns in table 'historico':
 * @property integer $idhistorico
 * @property integer $idrequisicoes
 * @property integer $idusuarios
 * @property string $data
 * @property string $descricao
 */
class historico extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return historico the static model class
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
		return 'historico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idrequisicoes, idusuarios, descricao', 'required'),
			array('idhistorico, idrequisicoes, idusuarios', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idhistorico, idrequisicoes, idusuarios, data, descricao', 'safe', 'on'=>'search'),
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
			'requisicoes' => array(self::BELONGS_TO, 'requisicoes', 'idrequisicoes'),
			'usuarios' => array(self::BELONGS_TO, 'User', 'idusuarios'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idhistorico' => 'Idhistorico',
			'idrequisicoes' => 'Idrequisicoes',
			'idusuarios' => 'Idusuarios',
			'data' => 'Data',
			'descricao' => 'Descrição',
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

		$criteria->compare('idhistorico',$this->idhistorico);

		$criteria->compare('idrequisicoes',$this->idrequisicoes);

		$criteria->compare('idusuarios',$this->idusuarios);

		$criteria->compare('data',$this->data,true);

		$criteria->compare('descricao',$this->descricao,true);

		return new CActiveDataProvider('historico', array(
			'criteria'=>$criteria,
		));
	}
}