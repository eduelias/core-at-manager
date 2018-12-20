<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'historico-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
        <?php echo CHtml::activeHiddenField($model,'idusuarios',array('value'=>Yii::app()->user->getId())); ?>
	</div>
    
	<div class="row">
        <?php echo CHtml::activeHiddenField($model,'idrequisicoes',array('value'=>$model->idrequisicoes)); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Inserir' : 'Concluir'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->