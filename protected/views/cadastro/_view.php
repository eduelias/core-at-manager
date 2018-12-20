<div class="view">

	<div align="right"><b><?php echo CHtml::link(CHtml::encode('Detalhes'), array('view', 'id'=>$data->idclifor)); ?></b></div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::mailto($data->email); ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('telefone')); ?>:</b>
	<?php echo CHtml::encode($data->telefone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cidade')); ?>:</b>
	<?php echo CHtml::encode($data->cidade.' - '.$data->uf); ?>
	<br />
    
    <?php foreach ($data->usuarios as $umodel) :?>
    <b>Login: </b><?=$umodel->usuario?>&nbsp;|&nbsp;
    <? endforeach; ?>
</div>