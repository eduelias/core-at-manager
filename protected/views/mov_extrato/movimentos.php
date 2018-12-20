<style>
.hidden{
	display:none;
}
</style>
<script>
	TIPO = '';
	caixa = <?=(isset($_GET['caixa']))?$_GET['caixa']:2?>;
	hoje = {
		dia:<?=date('d')?>,
		mes:<?=date('m')?>,
		ano:<?=date('Y')?>,
		
		p_mes:function(){
			if (this.mes == 12) {
				this.ano++;
				this.mes = 1;
			} else {
				this.mes++;
			}
			
			return this.mes;
		},
		
		a_mes:function(){
			if (this.mes == 1) {
				this.ano--;
				this.mes = 12;
			} else {
				this.mes--;
			}
			
			return this.mes;
		}
	}
		
	muda = function (url) {
		$.fn.yiiGridView.update('mov_grid', {
    		type:'GET',
    		url:url
		});
		$.fn.yiiGridView.update('s_inicial', {
    		type:'GET',
    		url:url
		});
		mostra = document.getElementById('abc');
		mostra.value = hoje.mes+'/'+hoje.ano;
	}
	
	proximo = function () {
		yurl = 'http://teste.coreos.com.br/gerenciador/index.php?r=mov_extrato/movimentos&mes='+hoje.p_mes()+'&ano='+hoje.ano+'&caixa='+caixa;
		muda(yurl);
	}
	
	anterior = function(){
		yurl = 'http://teste.coreos.com.br/gerenciador/index.php?r=mov_extrato/movimentos&mes='+hoje.a_mes()+'&ano='+hoje.ano+'&caixa='+caixa;
		muda(yurl);
	}
</script>
<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	  'id'=>'addcustdialog',
	  'options'=>array(
		'title'=>'Pagar conta',
		'autoOpen'=>false,
		'modal'=>false,
		'width'=>'650px',
		'buttons'=>array(
		  'Baixar hoje'=>'js:baixa',
		  'Baixar na data'=>'js:abre_data',
		),
	  ),
	));
	echo '<div id="addcust_content"></div>';
	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	  'id'=>'bddcustdialog',
	  'options'=>array(
		'title'=>'Escolha o banco',
		'autoOpen'=>false,
		'modal'=>false,
		'width'=>'300px',
		'buttons'=>array(
		  'Ok'=>'js:baixa_data',
		),
	  ),
	));
?>
<div id='bddcust_content'><input type='text' id='el_data'>
<script type="text/javascript">
	$(function() {
		$('#el_data').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['pt-BR'], {'dateFormat':'dd/mm/yy','changeMonth':'true','changeYear':'true','showButtonPanel':'true','constrainInput':'true','duration':'fast','showAnim':'slide'})); 
	});
	</script>

</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
<script type="text/javascript">
function opendialog(id){
	CONTA = id;
  //ajax load content, then:
  $("#addcustdialog").html('<iframe src="http://teste.coreos.com.br/gerenciador/index.php?r=mov_contas/view&id='+id+'" width="630px" height="600px"></iframe>');
  $("#addcustdialog").dialog('option','position',[window.innerWidth/2-505,50]);
  $("#addcustdialog").dialog("open");
}

function baixa_data(){
	TIPO = '2&data='+document.getElementById('el_data').value;	
	$('#bddcustdialog').dialog('close'); 
	baixa();
}

function abre_data(){
	$('#addcustdialog').dialog('close'); 
	$('#bddcustdialog').dialog('open'); 
}

function baixa(){		
//url:"http://teste.coreos.com.br/gerenciador/index.php?r=mov_extrato/baixajax&baixa=1&id="+CONTA+'&caixa='+caixa,
		$.fn.yiiGridView.update('mov_grid', {
		type:'GET',
		url:"<?=Yii::app()->createUrl("/mov_extrato/baixajax");?>&idccorrentes="+caixa+"&idmov_contas="+CONTA+"&baixa=1"+TIPO,
		success:function() {
			$.fn.yiiGridView.update('contas');
			$.fn.yiiGridView.update('s_inicial');
			$.fn.yiiGridView.update('mov_grid');
		}
	});	
}

</script> 
<table width="200" border="1">
<tr>
	<td>	
    	<button name="MES ANTERIOR" onClick="anterior()">MÊS ANTERIOR</button>&nbsp;Mes/Ano:<input type="text" id="abc" disabled size="5">&nbsp;<button name="PROXIMO MES" onClick="proximo()">PROXIMO MÊS</button>
    </td>
    <td>
    	<?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'contas',
                'dataProvider'=>$dp_contas,
				'summaryCssClass'=>'hidden',
                'columns'=>array(
					'contas.descr',
					'valor_total',
					'data_venc',
					
					array(
						'type' => 'raw',
						'value'=>'"<a href=# onclick=\'opendialog(".$data->idmov_contas.")\'>BAIXA</a>"'
					)					
                ), 
            )); ?>
    </td>
</tr>
<tr>
	<td><?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'s_inicial',
                'dataProvider'=>$dp_saldo,
				'summaryCssClass'=>'hidden',
                'columns'=>array(
					'saldo_inicial',
					'saldo_atual'
                ), 
            )); ?>
    </td>
</tr>
<tr>
    <td><?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'mov_grid',
                'dataProvider'=>$dataProvider,
				'summaryCssClass'=>'hidden',
                'columns'=>array(
					'data',
					'parcela.mov_contas.contas.descr',
					'valor',
					'operacao'
                ), 
            )); ?></td>
  </tr>
<tr><td></td></tr>
</table>
<script>
		mostra = document.getElementById('abc');
		mostra.value = hoje.mes+'/'+hoje.ano;
</script>