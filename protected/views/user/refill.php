<?php
/**
 * @var $oUser User
 * @var $this Controller
 * @var $oUserMoneysTransaction UserMoneysTransactions
 */
if (Yii::app()->user->getFlash('userNotice')) {
	echo '<div class="">' . Yii::app()->user->getFlash('userNotice') . '</div>';
}
$aMenuItems = array(
	array('label'=>'Мои купоны','url'=>$this->createUrl('/user/index')),
	array('label'=>'Личные данные','url'=>$this->createUrl('/user/info')),
	array('label'=>'Настройки','url'=>$this->createUrl('/user/settings')),
	array('label'=>'Личный счет','url'=>$this->createUrl('/user/refill')),
);

$this->widget('zii.widgets.CMenu',array(
		'items'=> $aMenuItems ,
		'itemCssClass'=>'btn-sm btn-success',
		'htmlOptions'=>array('class'=>'user_menu'),
	));

?>
	<h3>Ваш личный счет</h3>
<p>В данном разделе личного кабинета Вы можете просмотреть статистику расходования собственных средств а так же пополнить баланс личного счета</p>
<?php
echo $oUser->UserMoneys->amount;

if (empty($aTransactions)) {
	return true;
}
echo '<h3>Движение личных средств</h3>';
echo '<table class="table" width="100%">';
echo '<tr><th>Дата</th><th>Описание транзакции</th><th>Сумма</th></tr>';
foreach ( $aTransactions as $oUserMoneysTransaction ) {
?>
	<tr class="<?=
	($oUserMoneysTransaction->type == UserMoneys::TRANSACTION_INCOME) ? 'success' : 'warning'
	?>">
		<td><?=$oUserMoneysTransaction->date?></td>
		<td><?=$oUserMoneysTransaction->comment?></td>
		<td><?=$oUserMoneysTransaction->amount?> руб.</td>
	</tr>
<?php
}
echo '</table>';