<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idstatus')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idstatus), array('view', 'id'=>$data->idstatus)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>