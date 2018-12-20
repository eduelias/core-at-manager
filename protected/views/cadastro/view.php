<?php
$this->breadcrumbs=array(
	'Cadastros'=>array('index'),
	$model->email,
);

$this->menu=array(
	array('label'=>'Listar cadastro', 'url'=>array('index')),
	array('label'=>'Inserir cadastro', 'url'=>array('create')),
	array('label'=>'Editar cadastro', 'url'=>array('update', 'id'=>$model->idclifor)),
	array('label'=>'Excluir cadastro', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idclifor),'confirm'=>'Tem certeza que deseja excluir esse registro?')),
	array('label'=>'Gerenciar cadastro', 'url'=>array('admin')),
);
?>

<h1>Cadastro #<?php echo $model->idclifor; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nome',
		'cnpj_cpf',
		array(
			'label'=>'email',
			'type'=>'raw',
			'value'=>CHtml::mailto($model->email)
		),
		'endereco',
		'telefone',
		'cidade',
		'uf',
	),
)); ?>
<br /><h2>Usuários de sistema:</h2>
<?php foreach ($model->usuarios as $umodel) : ?>
<?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$umodel,
        'attributes'=>array(
            array(
				'label'=>'',
				'type'=>'Raw',
				'value'=>CHtml::link(CHtml::encode('Editar'),array('User/Update','id'=>$umodel->idusuarios))
			),
            'usuario',
            'senha',
            'nivel',
        ),
    )); ?><br />
<?php endforeach; ?>