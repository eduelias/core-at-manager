<table width="200" border="1">
  <tr><td rowspan="3"><span class="view"><?php echo CHtml::link(CHtml::encode($data->idusuarios), array('view', 'id'=>$data->idusuarios)); ?></span></td></tr>
  <tr>
    <th align="right" valign="middle" scope="row"><span class="view"><b><?php echo CHtml::encode($data->idclifor0->getAttributeLabel('nome')); ?></b></span></th>
    <td><span class="view"><?php echo CHtml::encode($data->idclifor0->nome); ?></span></td>
    <th align="right" valign="middle" scope="row"><span class="view"><b><?php echo CHtml::encode($data->idclifor0->getAttributeLabel('email')); ?></b></span></th>
    <td><span class="view"><?php echo CHtml::encode($data->idclifor0->email); ?></span></td>
  </tr>
  <tr>
    <th align="right" valign="middle" scope="row"><span class="view"><b><?php echo CHtml::encode($data->getAttributeLabel('usuario')); ?></b></span></th>
    <td><span class="view"><?php echo CHtml::encode($data->usuario); ?></span></td>
    <th align="right" valign="middle" scope="row"><span class="view"><b><?php echo CHtml::encode($data->getAttributeLabel('nivel')); ?></b></span></th>
    <td><span class="view"><?php echo CHtml::encode($data->nivel); ?></span></td>
  </tr>
</table>
