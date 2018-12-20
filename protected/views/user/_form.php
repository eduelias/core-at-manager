<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos marcados com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idclifor'); ?>
		<?php echo Chtml::activeDropDownList($model,'idclifor',CHtml::listData(cadastro::model()->findAll(),'idclifor','nome')); ?>
		<?php echo $form->error($model,'idclifor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usuario'); ?>
		<?php echo $form->textField($model,'usuario',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'usuario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'senha'); ?>
        <?php 
			echo CHtml::activePasswordField($model,'senha',array('size'=>10,'maxlength'=>10));
		?>
		<?php echo $form->error($model,'senha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nivel'); ?>
		<?php echo $form->textField($model,'nivel'); ?>
		<?php echo $form->error($model,'nivel'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Inserir' : 'Concluir'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->