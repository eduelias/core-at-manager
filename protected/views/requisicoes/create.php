<?php
$proj = projetos::model()->findByPk($_GET['id']);

$this->breadcrumbs=array(
	'Projeto: '.$proj->folder_name=>array('projetos/manage','id'=>$_GET['id']),
	'Nova Requisição',
);
?>

<h1><?=$proj->nome?> - Nova requisição</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>