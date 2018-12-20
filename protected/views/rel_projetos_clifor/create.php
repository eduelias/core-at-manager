<?php
$projeto = projetos::model()->findByPk($_GET['id']);

$this->breadcrumbs=array(
	'Projeto: '.$projeto->folder_name=>array('projetos/manage','id'=>$_GET['id']),
	'Envolvido',
);

$this->menu=array(
	array('label'=>'Novo Perfil', 'url'=>array('cadastro/createnow','idprojeto'=>$_GET['id'])),
	array('label'=>'Lista', 'url'=>array('index')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>