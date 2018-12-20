<?php
$this->breadcrumbs=array(
	'Projeto: '.$projeto->folder_name=>array('projetos/manage','id'=>$_GET['id_proj']),
	'Conta',
);

$this->menu=array(
	array('label'=>'Inserir mov_contas', 'url'=>array('create')),
	array('label'=>'Gerenciar mov_contas', 'url'=>array('admin')),
);
?>

<h1>Mov Contases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
