<?php
/**
 * Class ActionTerms
 * @property integer $id
 * @property string $description
 */


class ActionTerms extends CActiveRecord {

	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'action_terms';
	}

	public function scopes()
	{
		return array(
			'isActive'=>array(
				'condition'=>'is_active=1',
			),
		);
	}

}