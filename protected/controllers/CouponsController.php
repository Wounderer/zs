<?php
/**
 * Controller $this
 */

class CouponsController extends Controller {

	public function actionBuy() {

		if (Yii::app()->user->getId() === null) {
			$this->redirect($this->createUrl('/site/login'));
		}

		$oActions = new Actions();
		$iActionId = Yii::app()->request->getQuery('action_id');
		$oAction = $oActions->model()->findByPk( $iActionId );
		if (!$oAction) {
			$this->show404();
			return true;
		}

		$iActionVariationId = Yii::app()->request->getQuery('variation_id');

		$oActionVariation = ActionVariations::getVariationById( $iActionVariationId );
		if (!$oActionVariation) {
			$this->show404();
			return true;
		}

		// Приобретение купона
		$bIsConfirmed = Yii::app()->request->getQuery('confirmed', 0);
		if ($bIsConfirmed == 1) {
			$iCouponId  = $this->buyCoupon($oAction, $oActionVariation);
			Yii::app()->user->setFlash('userNotice', 'Вы успешно приобрели купон.');
			$this->redirect($this->createUrl('user/couponDisplay', array( 'id' => $iCouponId )));
		}


		$this->render('/coupons/buy', compact('oAction', 'oActionVariation'));
	}

	public function buyCoupon( Actions $oAction, ActionVariations $oActionVariation ) {
		//  Создать купон
		$oUser = User::getUserById( Yii::app()->user->getId() );

		$oUserMoneys = UserMoneys::getUserMoney( $oUser->id );

		if ($oUser->UserMoneys->amount < $oActionVariation->cost) {
			// Редирект на страницу пополненя счета сделать тут
		$sButtons = '<hr/>'.CHtml::link('Пополнить счет', $this->createUrl('/user/refill'), array('class'=>'btn btn-sm btn-success'))
			.'&nbsp;&nbsp;&nbsp;'
		.CHtml::link('Купить онлайн', $this->createUrl('/user/buynow'), array('class'=>'btn btn-sm btn-success'));
			Yii::app()->user->setFlash('main_flash',
				'У Вас недостаточно средств на личном счете. Пополните баланс или приобретите купон через платежную систему'.$sButtons);
			$this->redirect($this->createUrl('/action/display', array('id'=>$oAction->id)));
		}

		$oUserCoupon = UserCoupons::createCouponByActionAndVariation($oAction, $oActionVariation);
		$oUserCoupon->save(false);

		$sTransactionComment = 'Приобретение купона по акции "' . $oAction->title .'"';

		if (!UserMoneys::addMoneyTransaction(
			$oUser, $sTransactionComment, UserMoneys::TRANSACTION_BUY, $oActionVariation->cost )
		) {
			die('Ошибка создания платежа');
		}

		return $oUserCoupon->id;
		// Списать деньги со счета
		// Сохранить купон
		// Переадресация в личный кабинет на купон
	}

} 