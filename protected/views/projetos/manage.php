<style>
.hidden{
	display:none;
}
.grid-view table.items th {
	display:none;
}
th, td, caption{
	border: 1px solid #D0E3EF;
	padding: 0;
	vertical-align:top;
}
h2 {
	padding: 15px 0px 0px 10px;
}
</style>
<h1><?=$projeto->nome?></h1>
<?php echo @$projeto->contratante[0]->cadastros->nome ?>

<table width="100px" border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
	<tr>
    <td rowspan='3'><h2>REQUISIÇÕES&nbsp;(<?php echo CHtml::link('+',array('requisicoes/create', 'id'=>$projeto->idprojetos))?>)</h2>
    	
      <?php foreach ($projeto->requisicoes as $req): ?>
      <?=$req->descr.' - <em>em '.$req->data_sistema.'</em> ('.CHtml::link('+',array('historico/create', 'id_proj'=>$projeto->idprojetos,'id_req'=>$req->idrequisicoes)).')'?>      
      <?php $dp = new CActiveDataProvider('historico',array('criteria'=>array('condition'=>'idrequisicoes = '.$req->idrequisicoes))); ?>
			<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'req_grid_'.$req->idrequisicoes,
                'dataProvider'=>$dp,
				'summaryCssClass'=>'hidden',
                'columns'=>array(
					'data',
					'descricao',
					'usuarios.usuario',
                ),
            )); ?>
      <?php endforeach; ?>
    </td><td><h2>CONTATOS&nbsp;(<?php echo CHtml::link('+',array('rel_projetos_clifor/create', 'id'=>$projeto->idprojetos))?>)</h2>
        	<?php $dp = new CActiveDataProvider('rel_projetos_clifor',array('criteria'=>array('condition'=>'idprojetos = '.$projeto->idprojetos))); ?>
			<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'conta_grid',
                'dataProvider'=>$dp,
				'summaryCssClass'=>'hidden',
                'columns'=>array(
					'cadastros.nome:text:Nome',
					'cadastros.email:text:Email',
                    'tipo:text:Tipo',
                    array(
                        'class'=>'CButtonColumn',
						'template'=>'{update}{delete}'
                    ),
                ),
            )); ?>
        </td>
  </tr>
    <tr>
  	<td align="center"><h2>CONTAS CONSOLIDADAS&nbsp;</h2><?php $dp = new CActiveDataProvider('mov_extrato',array('criteria'=>array('with'=>array('parcela.mov_contas'),'condition'=>'mov_contas.idprojetos = '.$projeto->idprojetos,'limit'=>'10'))); ?>
			<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'paga_grid',
                'dataProvider'=>$dp,
				'ajaxUpdate'=>true,
					'summaryCssClass'=>'hidden',
					'columns'=>array( 
					'data',
					'cc.nome',
					'parcela.mov_contas.contas.descr',
					'parcela.mov_contas.valor_total',
					'operacao',
                ),
            )); ?></td>
  </tr>
  <tr>
  	<td align="center"><h2>CONTAS PENDENTES&nbsp;(<?php echo CHtml::link('+',array('mov_contas/create', 'id_proj'=>$projeto->idprojetos))?>)</h2><?php $dp = new CActiveDataProvider('mov_contas',array('criteria'=>array('condition'=>'data_pgto is null and idprojetos ='.$projeto->idprojetos,'order'=>'t.data_venc asc'))); ?>
			<?php $ccorrentes = ccorrentes::model()->findAll(array('order'=>'nome asc')); ?>
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
		?><?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'pgtos',
                'dataProvider'=> $dp,
                'ajaxUpdate'=>true,
				'summaryCssClass'=>'hidden',
                'columns'=>array(
						'data_venc',
                        'contas.descr',
						'valor_total',
                        array(
                                'class'=>'CButtonColumn',
                                'template'=>'{baixa} {delete}', 
                                'buttons'=>array(
                                        'baixa' => array(
											'label'=>'ARRUMAR ISSO',
											'url'=>'Yii::app()->createUrl("/rel_mov_contas_formas_pg/baixaajax",array("mov[idmov_contas]"=>$data->idmov_contas

, "mov[valor]"=>$data->valor_total))', 
											'click'=>"function() {
	if(!confirm('Baixar este item?')) return false;
	$.fn.yiiGridView.update('pgtos', {
		type:'GET',
		url:$(this).attr('href')+'&mov[idccorrentes]='+A+'&mov[data]='+document.getElementById('movdata').value+'&mov[documento]='+prompt(),
		success:function() {
			$.fn.yiiGridView.update('pgtos');
			$.fn.yiiGridView.update('paga_grid');
		}
	});
	return false;
}"

                                        ),
                                ),
                        ),
                ),
        )); ?></td>
  </tr>
</table>
