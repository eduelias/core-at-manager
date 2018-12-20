<?php
$this->breadcrumbs=array(
	'Financeiro'=>array('mov_extrato/index'),
	'Baixa',
);

$this->menu=array(
	array('label'=>'Inicio', 'url'=>array('index')),
	array('label'=>'Extrato', 'url'=>array('admin')),
);
?>

<h1>Baixa</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>