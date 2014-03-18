<?php
/**
 * Class UserCoupons
 * @property integer $user_id
 * @property integer $id
 * @property integer $action_id
 * @property integer $cost
 * @property string $code
 * @property integer $used
 * @property string $expire
 * @property string $date
 * @property integer $variation_id
 */


class UserCoupons extends CActiveRecord {

	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'user_coupons';
	}

	public function primaryKey() {
		return 'id';
	}


	public function scopeByUserId( $iUserId ) {

		$this->getDbCriteria()->addCondition(
			'user_id = '.$iUserId
		);

		return $this;

	}

	public function scopeByCode( $sCode ) {

		$this->getDbCriteria()->addCondition(
			"`code`='".$sCode."'"
		);

		return $this;

	}

	public function scopeByActionId( $iActionId ) {
		$this->getDbCriteria()->addCondition(
			'action_id = '.$iActionId
		);

		return $this;
	}

	public static function getUserCoupons( $iUserId ) {
		$oUserCoupons = new UserCoupons();
		$aUserCoupons = $oUserCoupons->model()->scopeByUserId( $iUserId )->findAll();
		if (!$aUserCoupons) {
			$aUserCoupons = array();
		}
		return $aUserCoupons;
	}

	public static function createCouponByActionAndVariation( $oAction, $oActionVariation ) {
		$oUserCoupon = new UserCoupons();

		$sCode = $oUserCoupon->generateCode();

		$iCouponId = Yii::app()->db->createCommand("SELECT * FROM `coupons_pool` WHERE `used`=0 ORDER BY RAND() LIMIT 1")->queryRow();
		$oUserCoupon->id = $iCouponId['id'];
		$oUserCoupon->user_id = Yii::app()->user->getId();
		$oUserCoupon->action_id = $oAction->id;
		$oUserCoupon->cost = $oActionVariation->cost;
		$oUserCoupon->variation_id = $oActionVariation->id;
		$oUserCoupon->code = $sCode;
		$oUserCoupon->expire = $oAction->date_exp;
		$oUserCoupon->date = date('Y-m-d H:i:s', time());
		$oUserCoupon->used = '0';

		Yii::app()->db->createCommand("UPDATE `coupons_pool` SET `used`=1 WHERE `id`=".$iCouponId['id'])->query();

		return $oUserCoupon;
	}
	public function generateCode() {
		//TODO Вставить проверку уникальности ключа!!
		$sCode = rand(1000,9999);
		return $sCode;

	}

}