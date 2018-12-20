<div class="form">
<?php $aux = explode('(',$model->metadata->tableSchema->columns['tipo']->dbType); ?>
<?php $aux2 = explode("','",$aux[1]); ?>
<?php $aux2[0] = substr($aux2[0],1); ?>
<?php $aux2[count($aux2)-1] = substr($aux2[count($aux2)-1],0,-2); ?>
<?php foreach ($aux2 as $a) : $itens[$a] = $a ; endforeach; ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contas-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php echo Chtml::activeDropDownList($model,'tipo',$itens); ?>
		<?php echo $form->error($model,'tipo'); ?>

		<?php echo $form->labelEx($model,'descr'); ?>
		<?php echo $form->textField($model,'descr',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'descr'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Inserir' : 'Concluir'); ?>
	</div>

<?php $this->endWidget(); ?>
<p class="note">Campos marcados com <span class="required">*</span> são obrigatórios.</p>
</div><!-- form -->