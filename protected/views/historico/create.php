<?php
$req = requisicoes::model()->findByPk($_GET['id']);

$this->breadcrumbs=array(
	'Projetos'=>array('projetos/manage','id'=>$_GET['id']),
	'REQ: '.$req->descr,
);

?>
<h1>Requisição: <?=$req->descr?></h1>
<?php if (count($req->historico) > 0) { ?>
	<? foreach ($req->historico as $hist) : ?>
    	<div> <?=$hist->data?>&nbsp;|&nbsp;<?=$hist->descricao?>&nbsp;|&nbsp;<?=$hist->usuarios->usuario?></div>
     <? endforeach; ?>  
<? }; //endif ?>

<?php $model->idrequisicoes = $req->idrequisicoes; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>   