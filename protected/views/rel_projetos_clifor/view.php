<?php
$this->breadcrumbs=array(
	'rel_projetos_clifor'=>array('index'),
	$model->idclifor,
);

$this->menu=array(
	array('label'=>'Lista', 'url'=>array('index')),
	array('label'=>'Novo', 'url'=>array('create')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->idclifor)),
	array('label'=>'Excluir', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idclifor),'confirm'=>'Tem certeza que deseja excluir esse registro?')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>rel_projetos_clifor: #<?php echo $model->idclifor; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idprojetos',
		'idclifor',
		'tipo',
		'participacao',
	),
)); ?>
