<?php
$this->breadcrumbs=array(
	'Projetos',
);

$this->menu=array(
	array('label'=>'Novo', 'url'=>array('create')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Projetos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
