<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->idusuarios=>array('view','id'=>$model->idusuarios),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar User', 'url'=>array('index')),
	array('label'=>'Inserir User', 'url'=>array('create')),
	array('label'=>'Mostrar User', 'url'=>array('view', 'id'=>$model->idusuarios)),
	array('label'=>'Gerenciar User', 'url'=>array('admin')),
);
?>

<h1>Editar User <?php echo $model->idusuarios; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>