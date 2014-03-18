<?php
/**
 * Class User
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $name
 */
class User extends CActiveRecord {


	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'users';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'UserMoneys' => array(
				self::BELONGS_TO,
				'UserMoneys',
				'id',
			),
			'UserCoupons' => array(
				self::BELONGS_TO,
				'UserCoupons',
				'id',
			),
		);
	}

	public function scopes()
	{
		return array(
			'isActive'=>array(
				'condition'=>'is_active=1',
			),
		);
	}

	public function getUserById( $iUserId ) {
		$oUser = new User();
		$oUser = $oUser->findByPk( $iUserId );
		return $oUser;
	}


}