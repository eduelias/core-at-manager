<?php
$this->breadcrumbs=array(
	'rel_mov_contas_formas_pg'=>array('index'),
	$model->idrel_mov_contas,
);

$this->menu=array(
	array('label'=>'Lista', 'url'=>array('index')),
	array('label'=>'Novo', 'url'=>array('create')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->idrel_mov_contas)),
	array('label'=>'Excluir', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idrel_mov_contas),'confirm'=>'Tem certeza que deseja excluir esse registro?')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>rel_mov_contas_formas_pg: #<?php echo $model->idrel_mov_contas; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idrel_mov_contas',
		'idmov_contas',
		'idformas_pg',
		'valor',
	),
)); ?>
