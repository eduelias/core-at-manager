<?php
$this->breadcrumbs=array(
	'Estatus'=>array('index'),
	$model->idstatus=>array('view','id'=>$model->idstatus),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar status', 'url'=>array('index')),
	array('label'=>'Inserir status', 'url'=>array('create')),
	array('label'=>'Mostrar status', 'url'=>array('view', 'id'=>$model->idstatus)),
	array('label'=>'Gerenciar status', 'url'=>array('admin')),
);
?>

<h1>Estatus: <?php echo $model->idstatus; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>