<?php
$this->breadcrumbs=array(
	'Cadastros'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Listar cadastro', 'url'=>array('index')),
	array('label'=>'Inserir cadastro', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cadastro-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Cadastros</h1>

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
	'id'=>'cadastro-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'idclifor',
		'nome',
		'cnpj_cpf',
		'email',
		'endereco',
		'telefone',
		/*
		'cidade',
		'uf',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
