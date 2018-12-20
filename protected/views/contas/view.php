<?php
$this->breadcrumbs=array(
	'contas'=>array('index'),
	$model->idcontas,
);

$this->menu=array(
	array('label'=>'Lista', 'url'=>array('index')),
	array('label'=>'Novo', 'url'=>array('create')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->idcontas)),
	array('label'=>'Excluir', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idcontas),'confirm'=>'Tem certeza que deseja excluir esse registro?')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>contas: #<?php echo $model->idcontas; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idcontas',
		'tipo',
		'descr',
	),
)); ?>
