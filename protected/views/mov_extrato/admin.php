<?php
$this->breadcrumbs=array(
	'mov_extrato'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Lista mov_extrato', 'url'=>array('index')),
	array('label'=>'Novo mov_extrato', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('mov-extrato-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Mov Extratos</h1>

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
	'id'=>'mov-extrato-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'operacao',
		'cc.nome',
		'parcela.mov_contas.contas.descr',
		'data',
		
		'valor',/*
		'data_sistema',
		*/
	),
)); ?>
