<?php
$this->breadcrumbs=array(
	'rel_projetos_clifor'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Lista rel_projetos_clifor', 'url'=>array('index')),
	array('label'=>'Novo rel_projetos_clifor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('rel-projetos-clifor-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Rel Projetos Clifors</h1>

<p>
Podem ser usados os símbolos para pesquisa (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
ou <b>=</b>) no inicio de cada termo pesquisado.
</p>

<?php echo CHtml::link('Pesquisar','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'rel-projetos-clifor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'idprojetos',
		'idclifor',
		'tipo',
		'participacao',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
