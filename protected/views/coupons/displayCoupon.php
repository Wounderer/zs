<?php
/**
 * @var $oCoupon UserCoupons
 * @var $oUser User
 * @var $oAction Actions
 * @var $oActionVariation
 *
*/

?>
<h4>Номер купона:<?=$oCoupon->id?></h4>
<h4>Пин-код купона:<?=$oCoupon->code?></h4>
<h4>Действителен до:<?=$oCoupon->expire?></h4>
<h4>Название акции:<?=$oAction->title?></h4>
<h4>Описание:<?=$oActionVariation->name?></h4>
<?=$oActionVariation->description?>