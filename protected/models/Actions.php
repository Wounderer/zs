<?php
/**
 * Class Actions
 * @property integer $id
 * @property string $description
 * @property string $title
 * @property integer $is_active
 * @property integer $category
 * @property string $date_start
 * @property string $date_end
 * @property string $date_exp
 * @property integer $views
 */


class Actions extends CActiveRecord {

	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'actions';
	}

	public function scopes()
	{
		return array(
			'isActive'=>array(
				'condition'=>'is_active=1',
			),
		);
	}

	public function scopeByCategory( $iCategoryId ) {

		$this->getDbCriteria()->addCondition(
			'category = '.$iCategoryId
		);

		return $this;

	}

	public function scopeActive() {
		$this->getDbCriteria()->addCondition(
			'is_active = 1'
		);

		return $this;
	}

	public function scopeCurrent() {
		$sCurrentTime = date( 'Y-m-d H:i:s', time() );
		$this->getDbCriteria()->addCondition(
			"date_start <= '" . $sCurrentTime . "' AND date_end >= '" . $sCurrentTime . "'"
		);

		return $this;
	}

	public function scopePast() {
		$sCurrentTime = date( 'Y-m-d H:i:s', time() );
		$this->getDbCriteria()->addCondition(
			"date_end < '" . $sCurrentTime . "'"
		);

		return $this;
	}

	public function scopeBySoonEnd() {
		$this->getDbCriteria()->order = "date_end DESC";
		$this->getDbCriteria()->limit = 8;

		return $this;
	}

	public function scopeByViews() {
		$this->getDbCriteria()->order = "views DESC";
		$this->getDbCriteria()->limit = 8;

		return $this;
	}

	public static function getIndexActions() {
		$oActions = new Actions();
		$aActions = $oActions->model()->
			scopeActive()->
			scopeBySoonEnd()->
			findAll();
		return $aActions;
	}

	public static function getMostViewedActions() {
		$oActions = new Actions();
		$aActions = $oActions->model()->
			scopeActive()->
			scopeByViews()->
			findAll();
		return $aActions;
	}

	public static function createByFormData( $aFormData ) {
		$oAction = new Actions();
		$oAction->setAttributes( $aFormData, false );
		$oAction->save();
	}

	protected function afterFind() {
		$this->terms = unserialize($this->terms);
		parent::afterFind();
	}

	protected function beforeSave() {
		$this->terms = serialize($this->terms);
		return parent::beforeSave();
	}

}