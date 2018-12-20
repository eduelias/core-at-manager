<?php

/**
 * This is the model class for table "mov_contas".
 *
 * The followings are the available columns in table 'mov_contas':
 * @property integer $idmov_contas
 * @property integer $idusuarios
 * @property integer $idprojetos
 * @property integer $idcontas
 * @property string $valor_total
 * @property string $data_venc
 * @property string $data_comp
 * @property string $data_pgto
 * @property string $data_sistema
 */
class mov_contas extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return mov_contas the static model class
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
		return 'mov_contas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idusuarios, idprojetos, idcontas, valor_total, data_venc, data_comp', 'required'),
			array('idusuarios, idprojetos, idcontas', 'numerical', 'integerOnly'=>true),
			array('valor_total', 'length', 'max'=>9),
			array('data_pgto, data_sistema', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idmov_contas, idusuarios, idprojetos, idcontas, valor_total, data_venc, data_comp, data_pgto, data_sistema', 'safe', 'on'=>'search'),
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
					$this->$columnName = ($this->$columnName == '31/12/1969 21:00:00')?' ':$this->$columnName;                              
				}elseif ($column->dbType == 'timestamp'){                                
					$this->$columnName = Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($this->$columnName, 'yyyy-MM-dd hh:mm:ss'));
					$this->$columnName = ($this->$columnName == '31/12/1969 21:00:00')?'':$this->$columnName;                        
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
			'contas' => array(self::BELONGS_TO, 'contas', 'idcontas'),
			'projetos' => array(self::BELONGS_TO, 'projetos', 'idprojetos'),
			'usuarios' => array(self::BELONGS_TO, 'User', 'idusuarios'),
			'parcelas' => array(self::HAS_MANY, 'rel_mov_contas_formas_pg', 'idmov_contas'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idmov_contas' => 'Idmov Contas',
			'idusuarios' => 'Idusuarios',
			'idprojetos' => 'Projeto',
			'idcontas' => 'Conta',
			'valor_total' => 'Valor Total',
			'data_venc' => 'Vencimento',
			'data_comp' => 'Competencia',
			'data_pgto' => 'Pagamento',
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

		$criteria->compare('idmov_contas',$this->idmov_contas);

		$criteria->compare('idusuarios',$this->idusuarios);

		$criteria->compare('idprojetos',$this->idprojetos);

		$criteria->compare('idcontas',$this->idcontas);

		$criteria->compare('valor_total',$this->valor_total,true);

		$criteria->compare('data_venc',$this->data_venc,true);

		$criteria->compare('data_comp',$this->data_comp,true);

		$criteria->compare('data_pgto',$this->data_pgto,true);

		$criteria->compare('data_sistema',$this->data_sistema,true);

		return new CActiveDataProvider('mov_contas', array(
			'criteria'=>$criteria,
		));
	}
}