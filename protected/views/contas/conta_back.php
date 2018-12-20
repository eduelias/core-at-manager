<?php
if (isset($_GET['idprojetos'])) $_GET['id_proj'] = $_GET['idprojetos'];
$this->breadcrumbs=array(
	'Projetos'=>array('projetos/manage','id'=>$_GET['id_proj']),
	'Nova Movimentação'=>array('mov_contas/create','id_proj'=>$_GET['id_proj']),
	'Nova Conta',
);
?>

<h1>Nova conta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php	
	$rovel=new contas('search');
	$rovel->unsetAttributes();  // clear any default values
	if(isset($_GET['contas'])) $rovel->attributes=$_GET['contas']; ?>
    

<?php echo CHtml::link('Pesquisar','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$rovel,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'formas-pg-grid',
	'dataProvider'=>$rovel->search(),
	'filter'=>$rovel,
	'ajaxUpdate'=>true,
	'columns'=>array(
		'tipo',
		'descr',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
		),
	),
)); ?>