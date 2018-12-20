<?php
$this->breadcrumbs=array(
	'rel_projetos_clifor'=>array('index'),
	$model->idclifor=>array('view','id'=>$model->idclifor),
	'Editar',
);

$this->menu=array(
	array('label'=>'Lista', 'url'=>array('index')),
	array('label'=>'Novo', 'url'=>array('create')),
	array('label'=>'Exibir', 'url'=>array('view', 'id'=>$model->idclifor)),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Editar envolvido no projeto: "<?php echo $model->projeto->folder_name; ?>"</h1>

<?php echo $this->renderPartial('/rel_projetos_clifor/_form', array('model'=>$model)); ?>