<?php
$this->breadcrumbs=array(
	'Estatus',
);

$this->menu=array(
	array('label'=>'Inserir', 'url'=>array('create')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Estatus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
