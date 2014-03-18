<?php
/**
 * Class Comments
 * @property integer $id
 * @property string $content
 * @property integer $user_id
 * @property integer $action_id
 * @property integer $is_review
 * @property string $create_date
 */
class Comments extends CActiveRecord {

	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'comments';
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

	public function scopeByActionId( $iActionId ) {

		$this->getDbCriteria()->addCondition(
			'action_id = '.$iActionId
		);

		return $this;

	}

}