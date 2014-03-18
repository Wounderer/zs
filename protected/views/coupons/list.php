<?php
/**
 * @var $aUserCoupons array
 * @var $oUserCoupon UserCoupons
 */

$aUsedCoupons = array();
$aActiveCoupons = array();

foreach ($aUserCoupons as $oUserCoupon) {
	if ( $oUserCoupon->used == 1 ) {
		$aUsedCoupons[] = $oUserCoupon;
	}
	else {
		$aActiveCoupons[] = $oUserCoupon;
	}
}

echo '<h3>Неиспользованные купоны</h3>';
foreach ($aActiveCoupons as $oUserCoupon) {

	$oAction = Actions::model()->findByPk( $oUserCoupon->action_id );
		$aImages = ActionImages::getActionImages( $oAction->id );
		$oImage = $aImages[0];
		$aActionPrices = ActionVariations::getPricesForCouponByActionId( $oAction->id );
		$iCoupons = count(UserCoupons::model()->scopeByActionId( $oAction->id )->findAll());
		?>
		<a class="Coupon" href="<?= $this->createUrl('/user/couponDisplay', array('id'=>$oUserCoupon->id))?>" title="<?=$oAction->description?>">
			<div class="body" style="background: url('images/actions/<?= $oImage->action_id ?>/<?= $oImage->filename ?>')">
				<div class="preDescr">
					<div class="couponDiscount">
						-<?=$aActionPrices['discountTo']?>%
					</div>
				</div>
				<div class="descr">
					<p>
						<?= $oAction->title ?>
					</p>
					<p>
						<span class="timeLeft">11:13:58</span>
						<span class="couponBuyed">Купили: <?=$iCoupons?></span>
					</p>
				</div>
			</div>
			<div class="footerCoupon">
				<p class="couponPrice" style="<?=($oUserCoupon->used == 1) ? 'text-decoration:line-through' : ''?>"><?=$oUserCoupon->code?></p>
			</div>
		</a>
	<?php
}

echo '<h3>Использованные купоны</h3>';
foreach ($aUsedCoupons as $oUserCoupon) {

	$oAction = Actions::model()->findByPk( $oUserCoupon->action_id );
	$aImages = ActionImages::getActionImages( $oAction->id );
	$oImage = $aImages[0];
	$aActionPrices = ActionVariations::getPricesForCouponByActionId( $oAction->id );
	$iCoupons = count(UserCoupons::model()->scopeByActionId( $oAction->id )->findAll());
	?>
	<span class="Coupon" title="<?=$oAction->description?>">
		<div class="body" style="background: url('images/actions/<?= $oImage->action_id ?>/<?= $oImage->filename ?>')">
			<div class="preDescr">
				<div class="couponDiscount">
					-<?=$aActionPrices['discountTo']?>%
				</div>
			</div>
			<div class="descr">
				<p>
					<?= $oAction->title ?>
				</p>
				<p>
					<span class="timeLeft">11:13:58</span>
					<span class="couponBuyed">Купили: <?=$iCoupons?></span>
				</p>
			</div>
		</div>
		<div class="footerCoupon">
			<p class="couponPrice" style="text-decoration:line-through"><?=$oUserCoupon->code?></p>
		</div>
	</span>
<?php
}