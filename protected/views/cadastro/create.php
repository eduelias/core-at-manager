<?php
$this->breadcrumbs=array(
	'Cadastros'=>array('index'),
	'Incluir',
);

$this->menu=array(
	array('label'=>'List cadastro', 'url'=>array('index')),
	array('label'=>'Manage cadastro', 'url'=>array('admin')),
);
?>

<h1>Create cadastro</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>