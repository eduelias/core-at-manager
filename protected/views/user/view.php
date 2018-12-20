<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->usuario,
);

$this->menu=array(
	array('label'=>'Listar Usuários', 'url'=>array('index')),
	array('label'=>'Inserir Usuários', 'url'=>array('create')),
	array('label'=>'Editar Usuário', 'url'=>array('update', 'id'=>$model->idusuarios)),
	array('label'=>'Excluir Usuário', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idusuarios),'confirm'=>'Tem certeza que deseja excluir esse registro?')),
	array('label'=>'Gerenciar Usuários', 'url'=>array('admin')),
);
?>

<h1>Usuário: "<u><?php echo $model->usuario; ?></u>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idusuarios',
		'idclifor',
		'usuario',
		'senha',
		'nivel',
	),
)); ?>