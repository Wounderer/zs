<?php
/**
 * Class Categoryes
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property array $actions
 */
class Categoryes extends CActiveRecord {

	public $actions;

	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'categoryes';
	}

	public function scopes()
	{
		return array(
			'isActive'=>array(
				'condition'=>'is_active=1',
			),
		);
	}

	public function scopeByDirection( $iDirection ) {

		$this->getDbCriteria()->addCondition(
			'directions LIKE "%.'.$iDirection.'.%"'
		);

		return $this;

	}

}