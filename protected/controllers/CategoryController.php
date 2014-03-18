<?php
/**
 * Controller $this
 */

class CategoryController extends Controller {

	public function actionDirection() {
		$oDirections = new Directions();
		$iDirectionId = Yii::app()->request->getQuery('id');
		$oDirection = $oDirections->model()->findByPk( $iDirectionId );

		if (!$oDirection) {
			$this->show404();
			return true;
		}

		$oCategoryes = new Categoryes();
		$aCategoryes = $oCategoryes->model()->scopeByDirection( $iDirectionId )->findAll();

		$this->render('/category/productsList', compact('oDirection', 'aCategoryes'));
	}

	public function actionList() {
		$iCategoryId = Yii::app()->request->getQuery('id', 1);

		$oCategoryes = new Categoryes();
		$oCategory = $oCategoryes->model()->findByPk( $iCategoryId );

		$oActions = new Actions();
		$oCategory->actions = $oActions->model()->scopeByCategory( $iCategoryId )->findAll();

		$this->render('/category/categoryList', compact('oCategory'));
	}

} 