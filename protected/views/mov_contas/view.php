<h1>Conta: <?php echo $model->contas->descr; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'contas.descr',
		'contas.tipo',
		'projetos.nome',
		'valor_total',
		'data_venc',
		'data_comp',
		'data_pgto',
		'data_sistema',
	),
)); ?>
<hr />
<h2>FORMA DE PAGAMENTO</h2>
<? if ($model->data_pgto == '') $arr = array('class'=>'CButtonColumn','template'=>'{delete}'); else $arr = array('value'=>'"PAGO"'); ?>
<?php $dp = new CActiveDataProvider('rel_mov_contas_formas_pg',array('criteria'=>array('with'=>'mov_extrato','condition'=>'idmov_contas ='.$model->idmov_contas))); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'parcelas',
	'dataProvider'=>$dp,
	'columns'=>array(
		'parcelas.descr',
		'ccorrentes.nome',
		'valor',
		$arr
	),
)); ?>
<hr />
<style>
div.form label {
	display:inline-block;
}
</style>
<div class="form">
<? if ($model->data_pgto == '') { ?>
<?php $m_contas = $model; ?>
<?php $model = rel_mov_contas_formas_pg::model(); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rel-mov-contas-formas-pg-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
    	<input type="hidden" value="<?=$m_contas->idmov_contas?>" name="rel_mov_contas_formas_pg[idmov_contas]" />
    </div>  

    <div class="row">
        <?php echo $form->labelEx($model,'idformas_pg'); ?>:
        <?php echo Chtml::activeDropDownList($model,'idformas_pg',CHtml::listData(formas_pg::model()->findAll(),'idformas_pg','descr')); ?>
        <?php echo $form->error($model,'idformas_pg'); ?>

		&nbsp;<?php echo $form->labelEx($model,'valor'); ?>:
		<?php echo $form->textField($model,'valor',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'valor'); ?>
        
         &nbsp; <?php echo $form->labelEx($model,'idccorrentes'); ?>:
        <?php echo Chtml::activeDropDownList($model,'idccorrentes',CHtml::listData(ccorrentes::model()->findAll(),'idccorrentes','nome')); ?>
        <?php echo $form->error($model,'idccorrentes'); ?> 
        
        &nbsp;<?php echo $form->labelEx($model,'recibo'); ?>:
		<?php echo $form->textField($model,'recibo',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'recibo'); ?>

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Inserir' : 'Inserir'); ?>
	</div>

<?php $this->endWidget(); ?>
<? } //endif ?>
</div><!-- form -->
