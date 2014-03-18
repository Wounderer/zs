<?php

class Directions extends CActiveRecord {

	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'directions';
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