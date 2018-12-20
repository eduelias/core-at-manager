<div class="view">

	<?php echo CHtml::link(CHtml::encode('Abrir'), array('manage', 'id'=>$data->idprojetos)); ?>&nbsp;|&nbsp;
	<?php echo CHtml::link(CHtml::encode('Detalhes'), array('view', 'id'=>$data->idprojetos)); ?>&nbsp;|&nbsp;
	<?php echo CHtml::link(CHtml::encode('Contas'), array('mov_contas/create', 'proj_id'=>$data->idprojetos)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_abertura')); ?>:</b>
	<?php echo $data->data_abertura; ?>
	<br />
    <p class="small">
   	<b><?php echo CHtml::encode('Inserido por'); ?>:</b>
	<?php echo CHtml::encode($data->user->usuario.' em '.$data->data_sistema); ?>
	</p>

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('data_prev_encerramento')); ?>:</b>
	<?php echo CHtml::encode($data->data_prev_encerramento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_encerrado')); ?>:</b>
	<?php echo CHtml::encode($data->data_encerrado); ?>
	<br />

	*/ ?>

</div>