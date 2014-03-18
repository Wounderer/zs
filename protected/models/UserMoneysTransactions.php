<?php
/**
 * Class UserMoneysTransactions
 * @property integer $user_id
 * @property integer $amount
 * @property string $date
 * @property string $comment
 * @property integer $type
 */

class UserMoneysTransactions extends CActiveRecord {

	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'user_moneys_transactions';
	}


	public function scopeByUserId( $iUserId ) {

		$this->getDbCriteria()->addCondition(
			'user_id = '.$iUserId,
			'LIMIT = 1'
		);

		return $this;

	}


	public static function getUserTransactions( $iUserId ) {
		return UserMoneysTransactions::model()->scopeByUserId( $iUserId )->findAll();
	}

}