<?php
$this->breadcrumbs=array(
	'Projetos'=>array('index'),
	$model->folder_name,
);

$this->menu=array(
	array('label'=>'Lista', 'url'=>array('index')),
	array('label'=>'Novo', 'url'=>array('create')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->idprojetos)),
	array('label'=>'Excluir', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idprojetos),'confirm'=>'Tem certeza que deseja excluir esse registro?')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Projeto: "<?php echo $model->nome; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nome',
		'descricao',
		'data_abertura',
		'folder_name',
		'data_sistema',
		'data_prev_encerramento',
		'data_encerrado',
		'user.usuario',
	),
)); ?>
