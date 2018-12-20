<?php
$this->breadcrumbs=array(
	'Financeiro'=>array('mov_extrato/index'),
	'Baixa',
);

$this->menu=array(
	array('label'=>'Inicio', 'url'=>array('mov_extrato/index')),
	array('label'=>'Extrato', 'url'=>array('mov_extrato/admin')),
	array('label'=>'+ Forma PG', 'url'=>array('formas_pg/create')),
	array('label'=>'+ Contas', 'url'=>array('contas/create')),
	array('label'=>'+ C/Correntes', 'url'=>array('ccorrentes/create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('rel-mov-contas-formas-pg-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php $ccorrentes = ccorrentes::model()->findAll(); ?><? if (is_object($model)) { ?>
<h1>Parcelas à serem 'baixadas'</h1>
		<select name="ccorrentes" id="idccorrentes" onchange="{ A = this.value; }">
        		<option value="-1">-- SELECIONE A CONTA QUE DARÁ BAIXA --</option>
        	<? foreach ($ccorrentes as $cc) : ?>
            	<option value="<?=$cc->idccorrentes?>"><?=$cc->nome?></option>
            <? endforeach; ?>
        </select>
        <input type="text" name="mov[data]" id='movdata' />
        <?php $this->widget('application.extensions.calendar.SCalendar',
			array(
			'inputField'=>'movdata',
		   'ifFormat'=>'%d/%m/%Y',
			'range'=>"[2009,2014]"
		));
		?>
        
<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'pgtos',
                'dataProvider'=> $model->search(),
                'ajaxUpdate'=>true,
                'columns'=>array(
						'idrel_mov_contas',
                        'mov_contas.contas.descr',
						'valor',
                        array(
                                'class'=>'CButtonColumn',
                                'template'=>'{baixa} {delete}', 
                                'buttons'=>array(
                                        'baixa' => array(
											'label'=>'bx',
											'url'=>'Yii::app()->createUrl("/rel_mov_contas_formas_pg/baixaajax",array("mov[idrel_mov_contas]"=>$data->idrel_mov_contas

, "mov[valor]"=>$data->valor))', 
											'click'=>"function() {
	if(!confirm('Baixar este item?')) return false;
	$.fn.yiiGridView.update('pgtos', {
		type:'GET',
		url:$(this).attr('href')+'&mov[idccorrentes]='+A+'&mov[documento]='+prompt(),
		success:function() {
			$.fn.yiiGridView.update('pgtos');
		}
	});
	return false;
}"

                                        ),
                                ),
                        ),
                ),
        )); ?>
		<? } else { ?>
				<br /><br /><br /><h2>SEM CONTAS A BAIXAR</h2>
        <?    }; ?>