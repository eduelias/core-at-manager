<div class="form">
<?php $parcelas = rel_mov_contas_formas_pg::model()->findAll(array('condition'=>'data_pgto is null')); ?>
<?php $ccorrentes = ccorrentes::model()->findAll(); ?>

<?php //FINDBYSQL com CAMPO CONCAT?? ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mov-extrato-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos marcados com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idrel_mov_contas'); ?><br />
		<select name="mov_extrato[idrel_mov_contas]" id="idrel_mov_contas">
        	<? foreach ($parcelas as $p) : ?>
            	<option value="<?=$p->idmov_contas?>"><?=$p->parcelas->tipo.' | '.$p->mov_contas->contas->descr.' - '.$p->valor?></option>
            <? endforeach; ?>
        </select>
		<?php echo $form->error($model,'idrel_mov_contas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idccorrentes'); ?>
		<?php echo Chtml::activeDropDownList($model,'idccorrentes',CHtml::listData($ccorrentes,'idccorrentes','nome')); ?>
		<?php echo $form->error($model,'idccorrentes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'documento'); ?>
		<?php echo $form->textField($model,'documento',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'documento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo $form->textField($model,'data',array('id'=>'data')); ?>
		<?php echo $form->error($model,'data'); ?>
		<?php $this->widget('application.extensions.calendar.SCalendar',
			array(
			'inputField'=>'data',
		    'ifFormat'=>'%d/%m/%Y',
			'range'=>"[2010,2015]"
		));
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Inserir' : 'Concluir'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->