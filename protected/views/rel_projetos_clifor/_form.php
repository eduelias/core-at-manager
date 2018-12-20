<div class="form">

<?php $aux = explode('(',$model->metadata->tableSchema->columns['tipo']->dbType); ?>
<?php $aux2 = explode("','",$aux[1]); ?>
<?php $aux2[0] = substr($aux2[0],1); ?>
<?php $aux2[count($aux2)-1] = substr($aux2[count($aux2)-1],0,-2); ?>
<?php foreach ($aux2 as $a) : $itens[$a] = $a ; endforeach; ?>

<?php if (isset($_GET['id']['idprojetos'])) $model->idprojetos = $_GET['id']['idprojetos']; ?>

<?php if (isset($_GET['id']['clifor'])) $model->idclifor = $_GET['id']['idclifor']; ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rel-projetos-clifor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
        <? if (isset($_GET['id']['idprojetos'])) { ?>
		<?php echo CHtml::activeHiddenField($model,'idprojetos',array('value'=>$_GET['id']['idprojetos'])); } else { ?>	  
		<? if (isset($_GET['id'])) { ?>
		<?php echo CHtml::activeHiddenField($model,'idprojetos',array('value'=>$_GET['id'])); } ?>        
        <input type="hidden" name="volta_projeto" value="1" />
		<?php echo $form->error($model,'idprojetos'); } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo'); ?>
        <?php echo Chtml::activeDropDownList($model,'tipo',$itens); ?>
		<?php //echo Chtml::activeDropDownList($model,'tipo',CHtml::listData($itens,'tipo')); ?>
		<?php echo $form->error($model,'tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idclifor'); ?>
		<?php echo Chtml::activeDropDownList($model,'idclifor',CHtml::listData(cadastro::model()->findAll(),'idclifor','nome')); ?>
		<?php echo $form->error($model,'idclifor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'participacao'); ?>
		<?php echo $form->textField($model,'participacao',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'participacao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Inserir' : 'Concluir'); ?>
	</div>

	<p class="note">Campos marcados com <span class="required">*</span> são obrigatórios.</p>

<?php $this->endWidget(); ?>

</div><!-- form -->