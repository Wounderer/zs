<?php
/**
 * @var $oCategory Categoryes
 */
echo '<div class="categoryName">'. $oCategory->name .'</div>';
echo '<span>'. $oCategory->description . '</span>';
echo '<div style="clear:both">';
$this->renderPartial('/action/list',array(
		'aActions'=>$oCategory->actions,
	));
echo '</div>';