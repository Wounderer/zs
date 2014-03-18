<?php
/**
 * @var $oAction Actions
 * @var $oActionVariation ActionVariations
 * @var $oTerm ActionTerms
 * @var $oActionImages ActionImages
 */
?>
<h1><?=$oAction->title?></h1>
<div class="action_top_block" style="background: url(/images/actions/<?=$oAction->id?>/<?=$oActionImages[0]->filename?>)">
	<div style="width:100%; clear:both">
	<div class="action_top_infoblock">
		<table width="100%">
			<tr>
				<td width="50%">Рейтинг акции</td>
				<td width="50%">**********</td>
			</tr>
			<tr>
				<td width="50%">Рейтинг компании</td>
				<td width="50%">**********</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center" class="infoblock_text">До конца акции <span class="orange">12:11:11</span></td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center" class="infoblock_text">Куплено купонов <span class="orange">15</span></td>
			</tr>
		</table>
	</div>
	</div>
	<div class="action_top_variations">
	<h3 class="orange">Варианты купонов по акции:</h3>
	<table class="table action_variations_table">
		<thead>
		<tr>
			<th>Вариант</th>
			<th>Описание</th>
			<th style="text-align: center">Обычная цена</th>
			<th style="text-align: center">Размер скидки</th>
			<th style="text-align: center">Цена со скидкой</th>
			<th style="text-align: center">&nbsp;</th>
		</tr>
		</thead>
		<?php
		$aActionVariations = ActionVariations::getActionVariations( $oAction->id );
		foreach ($aActionVariations as $oActionVariation) {
			?>
			<tr>
				<td><?=$oActionVariation->name?></td>
				<td><?=$oActionVariation->description?></td>
				<td class="regular_price"><?=$oActionVariation->regular_price?> Руб.</td>
				<td class="discount">-<?=$oActionVariation->discount?> %</td>
				<td class="discount_price"><?=$oActionVariation->discount_price?> Руб.</td>
				<td><?=
					CHtml::link('Купить за '. $oActionVariation->cost . ' рублей',
						$this->createUrl('/coupons/buy', array('action_id'=>$oAction->id, 'variation_id'=>$oActionVariation->id)),
						array('class'=>'btn btn-orange'))
					?></td>
			</tr>
		<?php
		}
		?>
	</table>
		</div>
</div>

<div class="action_middle_tabs">
	<ul class="nav block_tabs">
		<li class="active"><a href="#home" data-toggle="tab">Условия</a></li>
		<li><a href="#description" data-toggle="tab">Описание акции</a></li>
		<li><a href="#comments" data-toggle="tab">Отзывы покупателей</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="home">
			<ul class="action_terms">
			<?php
			foreach ( $aTerms as $oTerm ) {
				echo '<li>' . $oTerm->description . '</li>';
			}
			?>
			</ul>
		</div>
		<div class="tab-pane" id="description">
			<?= $oAction->description ?>
		</div>
		<div class="tab-pane" id="comments">
			<?php
			$iUserId = Yii::app()->user->getId();
			if ($iUserId) {
				$oForm = $this->beginWidget('CActiveForm', array(
						'id'=>'newCommentForm',
						'enableClientValidation'=>true,
						'clientOptions'=>array(
							'validateOnSubmit'=>true,
						),
					)); ?>
				<table class="table" style="width:100%">
					<tr>
						<td><?= $oForm->labelEx($oCommentForm, 'content')?></td>
						<td>
							<?= $oForm->textArea($oCommentForm, 'content', array('class'=>'form-control'))?>
							<?= $oForm->error($oCommentForm, 'content')?>
						</td>
						<td>
							<?php echo CHtml::submitButton('Отправить', array('class'=>'btn btn-success')); ?>
						</td>
					</tr>
				</table>
				<?php $this->endWidget(); } ?>
			<?php
			$this->renderPartial('/comments/comments', compact('aComments') );
			?>
		</div>
	</div>
</div>

<div class="action_bottom">
	<h4 class="block_title">О заведении</h4>
	<div style="padding: 10px">
		Информация о заведении
	</div>
</div>