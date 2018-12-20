<div class="form">
<?php  date_default_timezone_set('America/Sao_Paulo'); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projetos-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos marcados com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo CHtml::activeHiddenField($model,'idusuarios',array('value'=>Yii::app()->user->getId())); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>66,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div> 

	<div class="row">
		<?php echo $form->labelEx($model,'data_abertura'); ?>
        <?php echo CHtml::activeTextField($model,'data_abertura',array("id"=>"data_abertura")); ?>
		 <?php $this->widget('application.extensions.calendar.SCalendar',
			array(
			'inputField'=>'data_abertura',
		   'ifFormat'=>'%d/%m/%Y',
			'range'=>"[2009,2014]"
		));
		?> 
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'folder_name'); ?>
		<?php echo $form->textField($model,'folder_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'folder_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_prev_encerramento'); ?>
		<?php echo $form->textField($model,'data_prev_encerramento',array('id'=>'data_prev_encerramento')); ?>
        <?php $this->widget('application.extensions.calendar.SCalendar',
			array(
			'inputField'=>'data_prev_encerramento',
		   'ifFormat'=>'%d/%m/%Y',
			'range'=>"[2009,2014]"
		));
		?> 
		<?php echo $form->error($model,'data_prev_encerramento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_encerrado'); ?>
		<?php echo $form->textField($model,'data_encerrado'); ?>
		<?php echo $form->error($model,'data_encerrado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Inserir' : 'Concluir'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->