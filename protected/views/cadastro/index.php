<?php
$this->breadcrumbs=array(
	'Cadastros',
);

$this->menu=array(
	array('label'=>'Inserir cadastro', 'url'=>array('create')),
	array('label'=>'Gerenciar cadastro', 'url'=>array('admin')),
);
?>

<h1>Cadastros</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
