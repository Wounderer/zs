<?php
/**
 * Class UserMoneys
 * @property integer $user_id
 * @property integer $amount
 */

class UserMoneys extends CActiveRecord {

	const TRANSACTION_INCOME = 1;
	const TRANSACTION_BUY = 2;
	const TRANSACTION_RETURN = 3;
	const TRANSACTION_BONUS = 4;

	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'user_moneys';
	}


	public function scopeByUserId( $iUserId ) {

		$this->getDbCriteria()->addCondition(
			'user_id = '.$iUserId,
			'LIMIT = 1'
		);

		return $this;

	}

	public static function getUserMoney( $iUserId ) {
		$oUserMoneys = new UserMoneys();
		$oUserMoney = $oUserMoneys->model()->scopeByUserId( $iUserId )->find();
		if (!$oUserMoney) {
			$oUserMoneys->user_id = $iUserId;
			$oUserMoneys->amount = 0;
			$oUserMoneys->save();
			$oUserMoney = $oUserMoneys->model()->scopeByUserId( $iUserId )->find();
		}
		return $oUserMoney;
	}

	public static function addMoneyTransaction( User $oUser, $sComment, $iTransactionType, $iAmount ) {
		switch ( $iTransactionType ) {
			case self::TRANSACTION_BUY:
				if ( $oUser->UserMoneys->amount < $iAmount ) {
					return false;
				}
				$oUser->UserMoneys->amount = ( $oUser->UserMoneys->amount - $iAmount );
				$oUser->UserMoneys->save();

				$oUserMoneysTransaction = new UserMoneysTransactions();
				$oUserMoneysTransaction->user_id = $oUser->id;
				$oUserMoneysTransaction->amount = $iAmount;
				$oUserMoneysTransaction->type = $iTransactionType;
				$oUserMoneysTransaction->comment = $sComment;
				$oUserMoneysTransaction->save();
				return true;
				break;
			case self::TRANSACTION_INCOME:
				// Добавление средств на счет - в комментарии обязательно указывать откуда пришел платеж
				// TODO: В модель доавить внешний Айди платежа для проверки!
				return true;
				break;
		}
	}

}