<?php
$this->breadcrumbs=array(
	'Projeto:'.$model->projeto->folder_name=>array('/projetos/manage', 'id'=>$model->idprojetos),
	'Editar',
);
?>

<h1>Editar envolvido no projeto: "<?php echo $model->projeto->folder_name; ?>"</h1>

<?php echo $this->renderPartial('/rel_projetos_clifor/_form', array('model'=>$model)); ?>