<?php
$this->breadcrumbs=array(
	'Rel Projetos Clifors',
);

$this->menu=array(
	array('label'=>'Inserir rel_projetos_clifor', 'url'=>array('create')),
	array('label'=>'Gerenciar rel_projetos_clifor', 'url'=>array('admin')),
);
?>

<h1>Rel Projetos Clifors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
