<?php
$this->breadcrumbs=array(
	'Projetos'=>array('index'),
	'Novo',
);

$this->menu=array(
	array('label'=>'Lista', 'url'=>array('index')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Novo projeto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>