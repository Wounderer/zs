<?php
/**
 * Controller $this
 */

class AdminController extends Controller {
	public function actionIndex() {

		$this->checkUser();

		$oActionForm = new ActionForm();

		if( Yii::app()->request->getIsAjaxRequest() ) {
			echo CActiveForm::validate( $oActionForm );
			Yii::app()->end();
		}

		$aActionFormData = Yii::app()->request->getParam( get_class( $oActionForm ) );
		if ( !empty( $aActionFormData ) ) {
			Actions::createByFormData( $aActionFormData );
		}

		$aCategoryes = Categoryes::model()->isActive()->findAll();
		$aCategoryesList = array();
		foreach ($aCategoryes as $oCategory) {
			$aCategoryesList[$oCategory->id] = $oCategory->name;
		}

		$oDirections = new Directions();
		$aDirections = $oDirections->model()->isActive()->findAll();
		$aDirectionsList = array();

		foreach ($aDirections as $oDirection) {
			$aDirectionsList[$oDirection->id] = $oDirection->name;
		}

		$aCurrentActions = Actions::model()->scopeCurrent()->findAll();
		$aPastActions = Actions::model()->scopePast()->findAll();

		// COMPANYES
		$aCompanyesModels = Companyes::model()->findAll();
		$aCompanyes = CHtml::listData($aCompanyesModels, 'id', 'title');

		$oCompanyForm = new CompanyForm();

		$iCompanyId = Yii::app()->request->getQuery('company');
		if ( $iCompanyId ) {
			$oCompany = Companyes::model()->findByPk( $iCompanyId );
			die( $iCompanyId );
			$oCompanyForm->setAttributes( $oCompany->getAttributes() );
		}


		$this->render( '/admin/home', compact('oActionForm', 'aCategoryesList', 'aPastActions', 'aDirectionsList', 'aCurrentActions', 'aCompanyes', 'oCompanyForm') );
	}

	public function actionEditAction( $id ) {

		$this->checkUser();

		$iActionId = $id;

		$oAction = Actions::model()->findByPk( $iActionId );

		$aCategoryes = Categoryes::model()->isActive()->findAll();
		$aCategoryesList = array();
		foreach ($aCategoryes as $oCategory) {
			$aCategoryesList[$oCategory->id] = $oCategory->name;
		}

		$oActionForm = new ActionForm();

		$aActionFormData = Yii::app()->request->getParam( get_class( $oActionForm ) );
		if ( !empty( $aActionFormData ) ) {
			$oAction->setAttributes( $aActionFormData, false);
			$oAction->save();
			$oAction = Actions::model()->findByPk( $iActionId );
		}

		$oActionForm->setAttributes( $oAction->getAttributes() );

		$aActionTerms = ActionTerms::model()->findAll();

		$this->render( '/admin/actionForm', compact('oActionForm', 'aCategoryesList', 'aActionTerms'));
	}

	public function actioneditVariations() {
		$this->checkUser();

		$iActionId = Yii::app()->request->getQuery('id');

		$oAction = Actions::model()->findByPk( $iActionId );
		if (!$oAction) {
			$this->show404();
			return true;
		}

		$aActionVariations = ActionVariations::getActionVariations( $iActionId );
		$oVariationForm = new ActionVariationForm();
		$this->render( '/admin/editVariations', compact('aActionVariations', 'oVariationForm'));
	}



	public function actioneditImages() {

		$this->checkUser();

		$iActionId = Yii::app()->request->getQuery('id');
		if (!$iActionId) {
			$this->show404();
			return true;
		}

		$iDeleteImageId = Yii::app()->request->getQuery('delete_id');
		if ($iDeleteImageId) {
			$oActionImage = ActionImages::model()->findByPk( $iDeleteImageId );
			unlink( 'images/actions/' . $iActionId . '/' . $oActionImage->filename );
			ActionImages::model()->deleteByPk( $iDeleteImageId );

			$this->redirect( $this->createUrl('admin/editImages', array('id'=>$iActionId)) );
		}

		$oUploadForm = new ImageUploadForm();

		$aUploadFormData = Yii::app()->request->getParam( get_class( $oUploadForm ) );
		if ( !empty( $aUploadFormData ) ) {
			$newFile = CUploadedFile::getInstance($oUploadForm, 'filename');
			$oActionImage = new ActionImages();

			if (!is_dir('images/actions/'.$iActionId)) {
				mkdir('images/actions/'.$iActionId);
			}

			$sFileName = 'images/actions/'. $iActionId .'/'. $newFile->name;
			$newFile->saveAs( $sFileName );

			$oActionImage->filename = $newFile->name;
			$oActionImage->action_id = $iActionId;
			$oActionImage->save();

		}

		$aActionImages = ActionImages::getActionImages( $iActionId );
		$this->render( '/admin/editImages', compact('aActionImages', 'oUploadForm') );
	}

	public function checkUser() {
		$oUser = User::getUserById( Yii::app()->user->getId() );

		if ( !$oUser ) {
			$this->redirect( $this->createUrl('site/login') );
		}

		if ($oUser->is_admin == 0) {
			$this->show403();
			return true;
		}
	}

} 