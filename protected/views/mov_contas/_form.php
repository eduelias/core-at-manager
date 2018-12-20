<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mov-contas-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
    
    <?php if (isset($_GET['id_proj'])) { ?>
    	<h2>Projeto: <?php echo Chtml::encode(projetos::model()->findByPk($_GET['id_proj'])->nome); ?></h2>
        <?php if (isset($_GET['idcontas'])) $model->idcontas = $_GET['idcontas']; ?>
		<?php echo CHtml::activeHiddenField($model,'idprojetos',array('value'=>$_GET['id_proj'])); ?>
    <?php } else { ?>
            <div class="row">
                <?php echo $form->labelEx($model,'idprojetos'); ?>
                <?php echo Chtml::activeDropDownList($model,'idprojetos',CHtml::listData(projetos::model()->findAll(),'idprojetos','nome')); ?>
                <?php echo $form->error($model,'idprojetos'); ?>
            </div>        
	<?php } ?>
	<?php echo CHtml::activeHiddenField($model,'idusuarios',array('value'=>Yii::app()->user->getId())); ?>
            <div class="row">
                <?php echo $form->labelEx($model,'idcontas'); ?>
                <?php echo Chtml::activeDropDownList($model,'idcontas',CHtml::listData(contas::model()->findAll(),'idcontas','descr')); ?>
                <?php echo $form->error($model,'idcontas'); ?>
            </div> 

	<div class="row">
		<?php echo $form->labelEx($model,'valor_total'); ?>
		<?php echo $form->textField($model,'valor_total',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'valor_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_venc'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
	array(
		'model'=>$model,
		'attribute'=>'data_venc',

		'value' => date('d/m/Y'),
		'language' => 'pt-BR',
		'themeUrl' => Yii::app()->baseUrl.'/css' ,
		'theme'=>'pool',	//try 'bee' also to see the changes
		'cssFile'=>array('jquery-ui.css' /*,anotherfile.css, etc.css*/),


		//  optional: jquery Datepicker options
		'options' => array(
			'dateFormat'=>'dd/mm/yy',
			'changeMonth' => 'true',
			'changeYear' => 'true',
			'showButtonPanel' => 'true',
			'constrainInput' => 'true',
			'duration'=>'fast',
			'showAnim' =>'slide',
		),

		'htmlOptions'=>array(
		'style'=>'height:30px;
			background:#ffbf00;
			color:#00a;
			font-weight:bold;
			font-size:0.9em;
			border: 1px solid #A80;
			padding-left: 4px;'
		)
	)
);
?>
		<?php echo $form->error($model,'data_venc'); ?>

	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_comp'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
	array(
		'model'=>$model,
		'attribute'=>'data_comp',

		'value' => date('d/m/Y'),
		'language' => 'pt-BR',
		'themeUrl' => Yii::app()->baseUrl.'/css' ,
		'theme'=>'pool',	//try 'bee' also to see the changes
		'cssFile'=>array('jquery-ui.css' /*,anotherfile.css, etc.css*/),


		//  optional: jquery Datepicker options
		'options' => array(
			'dateFormat'=>'dd/mm/yy',
			'changeMonth' => 'true',
			'changeYear' => 'true',
			'showButtonPanel' => 'true',
			'constrainInput' => 'true',
			'duration'=>'fast',
			'showAnim' =>'slide',
		),

		'htmlOptions'=>array(
		'style'=>'height:30px;
			background:#ffbf00;
			color:#00a;
			font-weight:bold;
			font-size:0.9em;
			border: 1px solid #A80;
			padding-left: 4px;'
		)
	)
);
?>
		<?php echo $form->error($model,'data_comp'); ?>
	
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Inserir' : 'Concluir'); ?>
	</div>

<?php $this->endWidget(); ?>
<p class="note">Campos marcados com <span class="required">*</span> são obrigatórios.</p>
</div><!-- form -->