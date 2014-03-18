<?php
/**
 * Class ActionVariations
 * @property integer $id
 * @property integer $action_id
 * @property string $name
 * @property string $description
 * @property integer $cost
 * @property integer $discount
 * @property integer $regular_price
 * @property integer $discount_price
 */

class ActionVariations extends CActiveRecord {

	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'action_variations';
	}


	public function scopeByActionId( $iActionId ) {

		$this->getDbCriteria()->addCondition(
			'action_id = '.$iActionId
		);

		return $this;

	}

	public function scopeById( $iId ) {

		$this->getDbCriteria()->addCondition(
			'id = '.$iId
		);

		return $this;

	}


	public static function getActionVariations( $iActionId ) {
		$oActionVariations = new ActionVariations();
		$aVariations = $oActionVariations->model()->scopeByActionId( $iActionId )->findAll();
		return $aVariations;
	}

	public static function getVariationById( $iId ) {
		$oActionVariations = new ActionVariations();
		$oActionVariation = $oActionVariations->model()->scopeById( $iId )->find();
		return $oActionVariation;
	}

	public static function getPricesForCouponByActionId( $iActionId ) {
		$aActionVariations = self::getActionVariations( $iActionId );
		$iLowPrice = false;
		$iDiscountUpTo = false;
		foreach ($aActionVariations as $oActionVariation) {
			if (!$iLowPrice || $oActionVariation->cost < $iLowPrice) {
				$iLowPrice = $oActionVariation->cost;
			}
			if (!$iDiscountUpTo || $oActionVariation->discount > $iDiscountUpTo) {
				$iDiscountUpTo = $oActionVariation->discount;
			}
		}

		return array('lowPrice'=>$iLowPrice, 'discountTo'=>$iDiscountUpTo);

	}


}