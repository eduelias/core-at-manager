<?php
$this->breadcrumbs=array(
	'Rel Mov Contas Formas Pgs'=>array('index'),
	'Novo',
);

$this->menu=array(
	array('label'=>'Lista', 'url'=>array('index')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Novo(a) rel_mov_contas_formas_pg</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>