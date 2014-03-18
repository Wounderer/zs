<?php
/**
 * @var $aCurrentActions Actions
 * @var $oAction Actions
 * @var $this CController
 */
if (empty ($aCurrentActions)) {
	echo 'Сегодня активных акций нет';
	return true;
}

echo '<table class="table" style="width:80%">';
?>
<thead>
	<tr>
		<td>ID</td>
		<td>Название</td>
		<td>Время старта</td>
		<td>Время окончания</td>
		<td>Просмотров</td>
		<td>Куплено купонов</td>
		<td>Купонов на сумму</td>
	</tr>
</thead>
<?php
foreach ( $aCurrentActions as $oAction ) {

	$aCoupons = UserCoupons::model()->scopeByActionId( $oAction->id )->findAll();

	$iCouponsSumm = 0;
	foreach ( $aCoupons as $oCoupon ) {
		$iCouponsSumm = $iCouponsSumm + $oCoupon->cost;
	}

	$iCouponsCount = count( $aCoupons );

	$sRowClass = ($oAction->is_active == 1) ? 'success' : 'warning';
	echo '<tr class="' . $sRowClass . '">';
	echo '<td>' . $oAction->id . '</td>';
	echo '<td><a href="' . $this->createUrl('admin/editAction', array( 'id'=> $oAction->id ) ) . '" >' . $oAction->title . '</a></td>';
	echo '<td>' . $oAction->date_start . '</td>';
	echo '<td>' . $oAction->date_end . '</td>';
	echo '<td>' . $oAction->views . '</td>';
	echo '<td>' . $iCouponsCount . '</td>';
	echo '<td>' . $iCouponsSumm . ' Руб.</td>';
	echo '</tr>';
}
echo '</table>';

