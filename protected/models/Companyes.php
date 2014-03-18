<?php
/**
 * Class Companyes
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property integer $rate
 */
class Companyes extends CActiveRecord {

	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'companyes';
	}

	public function scopes()
	{
		return array(
			'isReview'=>array(
				'condition'=>'is_review=1',
			),
			'isActive'=>array(
				'condition'=>'is_active=1',
			),
		);
	}


}