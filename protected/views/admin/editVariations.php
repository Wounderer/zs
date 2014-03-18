<?php
/**

 */
$iActionId = Yii::app()->request->getQuery('id');

$oForm = $this->beginWidget('CActiveForm', array(
		'id'=>'editActionForm',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	));

?>
<div>
	<a href="<?=$this->createUrl('/admin/editAction', array('id'=>$iActionId))?>">Основное</a>
	<span>Вариации</span>
	<a href="<?=$this->createUrl('/admin/editImages', array('id'=>$iActionId))?>">Изображения</a>
</div>


<?php
$this->endWidget();

if ( empty($aActionVariations) ) {
	$this->renderPartial('/admin/editVariations', compact('oVariationForm'));
	return true;
}
?>

<?php

?>
<h3>Варианты купонов по акции:</h3>
<table class="table table-striped">
	<thead>
	<tr>
		<th>Вариант</th>
		<th>Описание</th>
		<th>Обычная цена</th>
		<th>Размер скидки</th>
		<th>Цена со скидкой</th>
		<th>Стоимость купона</th>
	</tr>
	</thead>
	<?php
	foreach ($aActionVariations as $oActionVariation) {
		?>
		<tr>
			<td><?=$oActionVariation->name?></td>
			<td><?=$oActionVariation->description?></td>
			<td><h4 class="text-warning"><?=$oActionVariation->regular_price?> Руб.</h4></td>
			<td><h4>-<?=$oActionVariation->discount?> %</h4></td>
			<td><h4 class="text-success"><?=$oActionVariation->discount_price?> Руб.</h4></td>
			<td><?=$oActionVariation->cost

				?></td>
		</tr>
	<?php
	}
	?>
</table>