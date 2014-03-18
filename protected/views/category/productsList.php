<?php
/**
 * @var $this Controller
 */
switch( $oDirection->id ) {
	case 1:
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/dir_woman.css');
		break;
	case 2:
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/dir_man.css');
		break;
	case 3:
		Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/dir_home.css');
		break;
}
foreach ($aCategoryes as $oCategory) {
	$oActions = new Actions();
	$oCategory->actions = $oActions->model()->scopeByCategory( $oCategory->id )->findAll();

echo '<div class="categoryName">'. $oCategory->name .'</div>';
$this->renderPartial('/action/list',array(
		'aActions'=>$oCategory->actions,
	));

}
