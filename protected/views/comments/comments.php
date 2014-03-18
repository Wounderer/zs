<?php
/**
 * @var $oComment Comments
 * @var $this CController
 * @var $oUser User
 */
if ( empty( $aComments ) ) {
	echo 'No comments';
	return true;
}

foreach ( $aComments as $oComment ) {
	$oUser = User::model()->findByPk( $oComment->user_id );
	echo '<small>' . $oComment->create_date . ' by ' . $oUser->name . '</small>';
	echo '<br />';
	echo $oComment->content;
	if ($oComment->is_review == 1) {
		echo '<br />by CouponController user';
	}
	echo '<hr />';
}