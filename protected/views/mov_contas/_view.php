<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idmov_contas')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idmov_contas), array('view', 'id'=>$data->idmov_contas)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idusuarios')); ?>:</b>
	<?php echo CHtml::encode($data->idusuarios); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idprojetos')); ?>:</b>
	<?php echo CHtml::encode($data->idprojetos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcontas')); ?>:</b>
	<?php echo CHtml::encode($data->idcontas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_total')); ?>:</b>
	<?php echo CHtml::encode($data->valor_total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_venc')); ?>:</b>
	<?php echo CHtml::encode($data->data_venc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_comp')); ?>:</b>
	<?php echo CHtml::encode($data->data_comp); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('data_pgto')); ?>:</b>
	<?php echo CHtml::encode($data->data_pgto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_sistema')); ?>:</b>
	<?php echo CHtml::encode($data->data_sistema); ?>
	<br />

	*/ ?>

</div>