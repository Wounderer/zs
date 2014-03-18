<h3>Личный кабинет</h3>
<?php
/**
 * @var $oUser User
 * @var $this Controller
 */
if (Yii::app()->user->getFlash('userNotice')) {
	echo '<div class="">' . Yii::app()->user->getFlash('userNotice') . '</div>';
}
$aMenuItems = array(
	array('label'=>'Мои купоны','url'=>$this->createUrl('/user/index')),
	array('label'=>'Личные данные','url'=>$this->createUrl('/user/info')),
	array('label'=>'Настройки','url'=>$this->createUrl('/user/settings')),
	array('label'=>'Личный счет','url'=>$this->createUrl('/user/refill')),
);

$this->widget('zii.widgets.CMenu',array(
		'items'=> $aMenuItems ,
		'itemCssClass'=>'btn-sm btn-success',
		'htmlOptions'=>array('class'=>'user_menu'),
	));

$aUserCoupons = UserCoupons::getUserCoupons( $oUser->id );
if (empty( $aUserCoupons )) {
	echo 'У Вас еще нет приобретенных купонов';
}
else {
	$this->renderPartial('/coupons/list', compact('aUserCoupons'));
}