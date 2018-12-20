<?php
$this->breadcrumbs=array(
	'Estatus'=>array('index'),
	$model->status,
);

$this->menu=array(
	array('label'=>'Lista', 'url'=>array('index')),
	array('label'=>'Novo', 'url'=>array('create')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->idstatus)),
	array('label'=>'Excluir', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idstatus),'confirm'=>'Tem certeza que deseja excluir esse registro?')),
	array('label'=>'Gerenciar status', 'url'=>array('admin')),
);
?>

<h1>Estatus: "<?php echo $model->status; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idstatus',
		'status',
	),
)); ?>
