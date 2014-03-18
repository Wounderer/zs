<h1>Приобретение купона</h1>
<?php
/**
 * @var $oActionVariation ActionVariations
 * @var $oAction Actions
 */
?>
Подтвердите приобретение купона <b>"<?=$oActionVariation->name?>"</b>.
<hr/>
Обратите внимание на правила покупки и спользования купона, а так же на особенности текущей акции во избежание недопониманий.
<br />
Так же, перед приобретением купона настоятельно рекомендуем внимательно ознакомиться с договором-офертой, на основании которого будет производиться текущая сделка.
<br /><br /><br />
<table class="table" width="100%">
	<tr>
		<td style="text-align: center">
			<?=CHtml::link('Купить с баланса личного счета',
				$this->createUrl('/coupons/buy', array('action_id'=>$oAction->id, 'variation_id'=>$oActionVariation->id, 'confirmed'=>1)
				)
			,array('class'=>'btn btn-success')
			);?>
		</td>
		<td style="text-align: center">или</td>
		<td style="text-align: center">
			<?=CHtml::link('Купить через платежную систему',
				$this->createUrl('/coupons/buy', array('action_id'=>$oAction->id, 'variation_id'=>$oActionVariation->id, 'confirmed'=>1)
				),array('class'=>'btn btn-success'));?>
		</td>
	</tr>
</table>