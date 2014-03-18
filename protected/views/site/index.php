<?php
/* @var $this SiteController
 * @var $aActions array
 * @var $aActionsByViews array
 */

?>

<h1>Заканчивающиеся предложения</h1>
<?php
if (empty( $aActions )) {
	echo 'Нет ближайших акций';
	 return true;
}

$this->renderPartial('/action/list', array('aActions'=>$aActions) );
?>

<h1>Самые популярные предложения</h1>
<?php
$this->renderPartial('/action/list', array('aActions'=>$aActionsByViews) );
?>