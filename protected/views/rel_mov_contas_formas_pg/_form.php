<style>
div.form label {
	display:inline-block;
}
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rel-mov-contas-formas-pg-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'idmov_contas'); ?>
        <?php echo Chtml::activeDropDownList($model,'idmov_contas',CHtml::listData(mov_contas::model()->findAll(),'idmov_contas','idmov_contas')); ?>
        <?php echo $form->error($model,'imov_contas'); ?>
    </div>  

    <div class="row">
        <?php echo $form->labelEx($model,'idformas_pg'); ?>
        <?php echo Chtml::activeDropDownList($model,'idformas_pg',CHtml::listData(formas_pg::model()->findAll(),'idformas_pg','descr')); ?>
        <?php echo $form->error($model,'idformas_pg'); ?>

		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Inserir' : 'Concluir'); ?>
	</div>

<?php $this->endWidget(); ?>
<p class="note">Campos marcados com <span class="required">*</span> são obrigatórios.</p>
</div><!-- form -->