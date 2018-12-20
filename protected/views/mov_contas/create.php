<?php
$projeto = (isset($_GET['id_proj']))? projetos::model()->findbyPk($_GET['id_proj']):'';

$this->breadcrumbs=array(
	'Projeto: '.$projeto->folder_name=>array('projetos/manage','id'=>$_GET['id_proj']),
	'Novo',
);

$this->menu=array(
	array('label'=>'Nova conta', 'url'=>array('contas/conta_back','id_proj'=>$_GET['id_proj'])),
);
?>

<h1>Novo compromisso</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>