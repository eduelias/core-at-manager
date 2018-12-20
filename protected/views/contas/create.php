<?php
$this->breadcrumbs=array(
	'Contas'=>array('index'),
	'Nova',
);

$this->menu=array(
	array('label'=>'Lista', 'url'=>array('index')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Nova conta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>