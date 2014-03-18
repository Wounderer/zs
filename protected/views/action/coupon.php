<?php
$aImages = ActionImages::getActionImages( $oAction->id );
$oImage = $aImages[0];
$aActionPrices = ActionVariations::getPricesForCouponByActionId( $oAction->id );
$iCoupons = count(UserCoupons::model()->scopeByActionId( $oAction->id )->findAll());
?>
	<a class="Coupon" href="<?= $this->createUrl('/action/display', array('id'=>$oAction->id))?>" title="<?=$oAction->description?>">
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
			<p class="couponPrice">от <?=$aActionPrices['lowPrice']?> руб.</p>
		</div>
	</a>
<?php