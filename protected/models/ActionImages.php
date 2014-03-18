<?php
/**
 * Class ActionImages
 * @property integer $action_id
 * @property string $filename
 * @property integer $order

 */


class ActionImages extends CActiveRecord {

	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'action_images';
	}

	public function scopeByActionId( $iActionId ) {

		$this->getDbCriteria()->addCondition(
			'action_id = '.$iActionId
		);
		$this->getDbCriteria()->order = '`order` DESC';

		return $this;

	}

	public static function getActionImages( $iActionId ) {
		$oActionImages = new ActionImages();
		$aActionImagess = $oActionImages->model()->scopeByActionId( $iActionId )->findAll();
		return $aActionImagess;
	}

}