<?php
$this->breadcrumbs=array(
	'Historicos'=>array('index'),
	$model->idhistorico,
);

$this->menu=array(
	array('label'=>'Listar historico', 'url'=>array('index')),
	array('label'=>'Inserir historico', 'url'=>array('create')),
	array('label'=>'Editar historico', 'url'=>array('update', 'id'=>$model->idhistorico)),
	array('label'=>'Excluir historico', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idhistorico),'confirm'=>'Tem certeza que deseja excluir esse registro?')),
	array('label'=>'Gerenciar historico', 'url'=>array('admin')),
);
?>

<h1>Exibindo historico #<?php echo $model->idhistorico; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idhistorico',
		'idrequisicoes',
		'idusuarios',
		'data',
		'descricao',
	),
)); ?>
