<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function init() {
		if (Yii::app()->urlManager->parseUrl(Yii::app()->request) != 'site/login') {
			Yii::app()->user->returnUrl = Yii::app()->request->requestUri;
		}
		$this->createTitle();
	}

	public function show404() {
		$this->render('/system/404');
		return true;
	}

	public function show403() {
		$this->render('/system/403');
		return true;
	}

	public function createTitle() {
		$sPostFix = 'отобранные при помощи уникальной системы пользовательского контроля качества предложений';
		switch ( Yii::app()->urlManager->parseUrl(Yii::app()->request) ) {
			case 'site/login':
				$sTitle = 'Авторизация';
				break;
			case 'category/direction':
				$oDirection = Directions::model()->findByPk( Yii::app()->request->getQuery('id') );
				$sTitle = 'Зеленоградские акции ' . $oDirection->name . ' со скидкой до 90% '.$sPostFix;
				break;
			default:
				$sTitle = 'Зелскидка - на порядок больше скидок и акций в Зеленограде. Только акции, ' . $sPostFix;
				break;
		}
		$this->setPageTitle($sTitle);
	}
}