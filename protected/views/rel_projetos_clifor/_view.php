<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idclifor')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idclifor), array('view', 'id'=>$data->idclifor)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idprojetos')); ?>:</b>
	<?php echo CHtml::encode($data->idprojetos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('participacao')); ?>:</b>
	<?php echo CHtml::encode($data->participacao); ?>
	<br />


</div>