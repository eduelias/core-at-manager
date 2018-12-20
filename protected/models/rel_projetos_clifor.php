<?php

/**
 * This is the model class for table "rel_projetos_clifor".
 *
 * The followings are the available columns in table 'rel_projetos_clifor':
 * @property integer $idprojetos
 * @property integer $idclifor
 * @property string $tipo
 * @property string $participacao
 */
class rel_projetos_clifor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return rel_projetos_clifor the static model class
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
		return 'rel_projetos_clifor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idprojetos, idclifor', 'required'),
			array('idprojetos, idclifor', 'numerical', 'integerOnly'=>true),
			array('tipo', 'length', 'max'=>13),
			array('participacao', 'length', 'max'=>12),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idprojetos, idclifor, tipo, participacao', 'safe', 'on'=>'search'),
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
			'cadastros' => array(self::BELONGS_TO, 'cadastro', 'idclifor'),
			'projeto' => array(self::BELONGS_TO, 'projetos', 'idprojetos')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idprojetos' => 'Projeto',
			'idclifor' => 'Perfil',
			'tipo' => 'Tipo',
			'participacao' => 'Participacao',
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

		$criteria->compare('idprojetos',$this->idprojetos);

		$criteria->compare('idclifor',$this->idclifor);

		$criteria->compare('tipo',$this->tipo,true);

		$criteria->compare('participacao',$this->participacao,true);

		return new CActiveDataProvider('rel_projetos_clifor', array(
			'criteria'=>$criteria,
		));
	}
}