<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bancos-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos marcados com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'saldo_inicial'); ?>
		<?php echo $form->textField($model,'saldo_inicial',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'saldo_inicial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'saldo_atual'); ?>
		<?php echo $form->textField($model,'saldo_atual',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'saldo_atual'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'agencia'); ?>
		<?php echo $form->textField($model,'agencia',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'agencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ccorrente'); ?>
		<?php echo $form->textField($model,'ccorrente',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'ccorrente'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Inserir' : 'Concluir'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->