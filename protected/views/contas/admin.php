<?php
$this->breadcrumbs=array(
	'contas'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Lista', 'url'=>array('index')),
	array('label'=>'Nova', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contas-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Contas</h1>

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
	'id'=>'contas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'idcontas',
		'tipo',
		'descr',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
