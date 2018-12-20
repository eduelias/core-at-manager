<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idhistorico')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idhistorico), array('view', 'id'=>$data->idhistorico)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idrequisicoes')); ?>:</b>
	<?php echo CHtml::encode($data->idrequisicoes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idusuarios')); ?>:</b>
	<?php echo CHtml::encode($data->idusuarios); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
	<?php echo CHtml::encode($data->data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
	<?php echo CHtml::encode($data->descricao); ?>
	<br />


</div>