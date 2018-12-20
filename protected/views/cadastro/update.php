<?php
$this->breadcrumbs=array(
	'Cadastros'=>array('index'),
	$model->idclifor=>array('view','id'=>$model->idclifor),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar cadastro', 'url'=>array('index')),
	array('label'=>'Inserir cadastro', 'url'=>array('create')),
	array('label'=>'Mostrar cadastro', 'url'=>array('view', 'id'=>$model->idclifor)),
	array('label'=>'Gerenciar cadastro', 'url'=>array('admin')),
);
?>

<h1>Editar cadastro <?php echo $model->idclifor; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>