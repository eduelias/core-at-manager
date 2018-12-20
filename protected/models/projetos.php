<?php

/**
 * This is the model class for table "projetos".
 *
 * The followings are the available columns in table 'projetos':
 * @property integer $idprojetos
 * @property integer $idusuarios
 * @property string $nome
 * @property string $descricao
 * @property string $data_abertura
 * @property string $folder_name
 * @property string $data_sistema
 * @property string $data_prev_encerramento
 * @property string $data_encerrado
 */
class projetos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return projetos the static model class
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
		return 'projetos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idusuarios, nome, descricao, data_abertura', 'required'),
			array('idusuarios', 'numerical', 'integerOnly'=>true),
			array('nome, folder_name', 'length', 'max'=>45),
			array('data_prev_encerramento, data_encerrado', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idprojetos, idusuarios, nome, descricao, data_abertura, folder_name, data_sistema, data_prev_encerramento, data_encerrado', 'safe', 'on'=>'search'),
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
					$this->$columnName = ($this->$columnName == '31/12/1969 21:00:00')?'':$this->$columnName;                              
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
			'documentos' => array(self::HAS_MANY, 'Documentos', 'idprojetos'),
			'mov_contas' => array(self::HAS_MANY, 'MovContas', 'idprojetos'),
			'movimentacao' => array(self::HAS_MANY, 'Movimentacao', 'idprojetos'),
			'user' => array(self::BELONGS_TO, 'User', 'idusuarios'),
			'etapas' => array(self::MANY_MANY, 'Etapas', 'rel_etapas_projetos(idetapas, idprojetos)'),
			'cadastro' => array(self::MANY_MANY, 'Clifor', 'rel_projetos_clifor(idprojetos, idclifor)'),
			'socios' => array(self::HAS_MANY,'rel_projetos_clifor','idprojetos', 'condition'=>'tipo = "SOCIO"'),
			'contratante' => array(self::HAS_MANY,'rel_projetos_clifor','idprojetos', 'condition'=>'tipo = "CONTRATANTE"'),
			'envolvidos' => array(self::HAS_MANY,'rel_projetos_clifor','idprojetos'),
			'insumos' => array(self::MANY_MANY, 'Insumos', 'rel_projetos_insumos(idprojetos, idinsumos)'),
			'rel_status_projetos' => array(self::HAS_MANY, 'RelStatusProjetos', 'idprojetos'),
			'requisicoes' => array(self::HAS_MANY, 'requisicoes', 'idprojetos')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idprojetos' => 'ID do Projeto',
			'idusuarios' => 'ID do Usuario',
			'nome' => 'Projeto',
			'descricao' => 'Descrição',
			'data_abertura' => 'Inicio',
			'folder_name' => 'Diretório',
			'data_sistema' => 'Inclusão',
			'data_prev_encerramento' => 'Previsão de encerramento',
			'data_encerrado' => 'Data Encerrado',
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

		$criteria->compare('idusuarios',$this->idusuarios);

		$criteria->compare('nome',$this->nome,true);

		$criteria->compare('descricao',$this->descricao,true);

		$criteria->compare('data_abertura',$this->data_abertura,true);

		$criteria->compare('folder_name',$this->folder_name,true);

		$criteria->compare('data_sistema',$this->data_sistema,true);

		$criteria->compare('data_prev_encerramento',$this->data_prev_encerramento,true);

		$criteria->compare('data_encerrado',$this->data_encerrado,true);

		return new CActiveDataProvider('projetos', array(
			'criteria'=>$criteria,
		));
	}
}