<?php
$this->breadcrumbs=array(
	'Projetos'=>array('index'),
	$model->folder_name=>array('view','id'=>$model->idprojetos),
	'Editar',
);

$this->menu=array(
	array('label'=>'Lista', 'url'=>array('index')),
	array('label'=>'Novo', 'url'=>array('create')),
	array('label'=>'Exibir', 'url'=>array('view', 'id'=>$model->idprojetos)),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Projeto: <?php echo $model->nome; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>