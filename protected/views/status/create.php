<?php
$this->breadcrumbs=array(
	'Estatus'=>array('index'),
	'Inserir',
);

$this->menu=array(
	array('label'=>'Listar', 'url'=>array('index')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Insrir estatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>