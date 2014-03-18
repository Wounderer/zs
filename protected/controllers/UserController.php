<?php
/**
 * Controller $this
 */

class UserController extends Controller {

	public function actionIndex() {
		if (Yii::app()->user->getId() === null) {
			$this->show403();
			return true;
		}
		else {
			$oUser = User::getUserById( Yii::app()->user->getId() );
		}

		$this->render('/user/index', compact('oUser'));
	}

	public function actionCouponDisplay( $id ) {
		if (Yii::app()->user->getId() === null) {
			$this->show403();
			return true;
		}
		else {
			$oUser = User::getUserById( Yii::app()->user->getId() );
		}

		$oCoupon = UserCoupons::model()->findByPk( $id );

		$oAction = Actions::model()->findByPk( $oCoupon->action_id );

		$oActionVariation = ActionVariations::model()->findByPk( $oCoupon->variation_id );

		if (!$id || !$oCoupon || $oCoupon->user_id != $oUser->id || !$oUser || !$oAction || !$oActionVariation) {
			$this->show404();
			return true;
		}

		$this->render('/coupons/displayCoupon', compact('oUser', 'oCoupon', 'oAction', 'oActionVariation'));
	}

	public function actionRefill() {
		if (Yii::app()->user->getId() === null) {
			$this->show403();
			return true;
		}
		else {
			$oUser = User::getUserById( Yii::app()->user->getId() );
		}

		$aTransactions = UserMoneysTransactions::getUserTransactions( $oUser->id );
		$this->render('/user/refill', compact('oUser', 'aTransactions'));
	}


} 