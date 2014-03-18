<?php
/**
 * Controller $this
 */

class ActionController extends Controller {

	public function actionDisplay() {

		$iActionId = Yii::app()->request->getQuery('id');
		$oAction = Actions::model()->findByPk( $iActionId );

		if (!$oAction) {
			$this->show404();
			return true;
		}

		// Добавляем один просмотр акции
		$oAction->saveCounters(array('views'=>1));


		$oCommentForm = new CommentForm();
		$iUserId = Yii::app()->user->getId();
		if ( $iUserId ) {
		$aCommentForm = Yii::app()->request->getParam( get_class( $oCommentForm ));
		if ($aCommentForm) {
			$oCommentForm->setAttributes($aCommentForm);
			if( Yii::app()->request->getIsAjaxRequest() ) {
				echo CActiveForm::validate( $oCommentForm );
				Yii::app()->end();
			}
			if ($oCommentForm->validate()) {
			$oComment = new Comments();
			$oComment->action_id = $oAction->id;
			$oComment->user_id = $iUserId;
			$oComment->content = $oCommentForm->content;
			$oComment->is_active = 1;
			$oComment->save();
			}
		}
		}

		$aTerms = ActionTerms::model()->findAllByPk( $oAction->terms );
		// Получаем комментарии к акции
		$aComments = Comments::model()->isActive()->scopeByActionId( $oAction->id )->findAll();

		$oActionImages = ActionImages::getActionImages( $oAction->id );
		$this->render( '/action/display', compact( 'oAction', 'aComments', 'oCommentForm', 'aTerms', 'oActionImages' ) );
	}



} 