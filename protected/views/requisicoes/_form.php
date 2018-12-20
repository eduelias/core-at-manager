<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'requisicoes-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <?php echo CHtml::activeHiddenField($model,'idusuarios',array('value'=>Yii::app()->user->getId())); ?>
   <?php echo CHtml::activeHiddenField($model,'idprojetos',array('value'=>$_GET['id'])); ?>

		<?php echo $form->labelEx($model,'prioridade'); ?>
		<?php echo $form->textField($model,'prioridade',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'prioridade'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'descr'); ?>
		<?php echo $form->textArea($model,'descr',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descr'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'data_previsao'); ?>
		<?php echo $form->textField($model,'data_previsao',array('size'=>45,'maxlength'=>45 ,'id'=>'data_previsao')); ?>
		<?php echo $form->error($model,'data_previsao'); ?>
        <?php $this->widget('application.extensions.calendar.SCalendar',
			array(
			'inputField'=>'data_previsao',
		   'ifFormat'=>'%d/%m/%Y',
			'range'=>"[2010,2014]"
		)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Inserir' : 'Concluir'); ?>
	</div>
    
   	<p class="note">Campos marcados com <span class="required">*</span> são obrigatórios.</p>

<?php $this->endWidget(); ?>

</div><!-- form -->