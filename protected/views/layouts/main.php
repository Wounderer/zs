<?php
/* @var $this Controller
 * @var $oDirection Directions
 */
if (Yii::app()->user->getId() !== null) {
	$oUser = User::model()->findByPk( Yii::app()->user->getId() );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="/js/jquery.easing.1.3.js"></script>
	<script src="/js/slider.js"></script>
	<script src="/js/custom.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div id="fixed_header">
	<table width="100%" border="1" class="header_table">
		<tr>
			<td class="header-line" width="33%">
				<form name="search" action="<?=$this->createUrl('/site/search')?>" method="post" style="display: block; width: 350px">
					<input type="text" class="form form-control" style="width: 227px;
display: inline-block;"/>
					<input type="submit" value="Искать" class="btn btn-success" />
				</form>
			</td>
			<td class="header-line" width="33%">
				<a href="http://zelskidka.ru" title="Zelkupon - сайт скидок Зеленограда" id="header_logo"></a>
			</td>
			<td class="header-line" width="33%">

				<?php
				if (Yii::app()->user->getId() !== null) {
					echo '<a class="header_balance_block" href="' . $this->createUrl('/user/refill') . '" title="Перейти к личному счету">На счету: ' .
						$oUser->UserMoneys->amount
					. ' руб.</a>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<ul class="top_header_menu">
					<li><a href="<?=$this->createUrl('/site/page',array('view'=>'howitworks'))?>">Как это работает</a></li>
					<li><a href="<?=$this->createUrl('/site/page',array('view'=>'qq'))?>">Контроль качества</a></li>
					<li><a href="<?=$this->createUrl('/site/page',array('view'=>'payments'))?>">Способы оплаты</a></li>
					<li><a href="<?=$this->createUrl('/site/page',array('view'=>'ask'))?>">Задать вопрос</a></li>
				</ul>
			</td>
			<td align="right" style="text-align: right">
				<?php
				if (Yii::app()->user->getId() !== null && $oUser->is_admin == 1) {
					echo CHtml::link('Админить', $this->createUrl('/admin/index'), array('class'=>'orangeitem') );
				}


				if (Yii::app()->user->getId() === null) {
					echo CHtml::link('Регистрация', $this->createUrl('/site/register'), array('class'=>'orangeitem') );
				}
				else {
					echo CHtml::link('Личный кабинет', $this->createUrl('/user/index'), array('class'=>'orangeitem') );
				}

				if (Yii::app()->user->getId() === null) {
					echo CHtml::link('Войти', $this->createUrl('/site/login'), array('class'=>'orangeitem') );
				}
				else {
					echo CHtml::link('Выйти', $this->createUrl('/site/logout'), array('class'=>'orangeitem') );
				}

				?>
			</td>
		</tr>
	</table>
</div>
<div id="wrap">
	<?php
	if (Yii::app()->user->hasFlash('main_flash')) {
	$flash = Yii::app()->user->getFlash('main_flash');
	if ($flash) {
		echo '<div class="flash_message">'.$flash.'</div>';
	}
	}
	?>
	<div id="left_menu">
		<?php
		$oDirections = new Directions();
		$aDirections = $oDirections->model()->isActive()->findAll();
		$aMenuItems = array();
		foreach ($aDirections as $oDirection) {
			$aSubmenuItems = array();

			$aCategoryes = Categoryes::model()->scopeByDirection( $oDirection->id )->findAll();
			if (!empty($aCategoryes)) {
			foreach ($aCategoryes as $oCategory) {
				$aSubmenuItems[] = array('label'=>$oCategory->name, 'url'=>$this->createUrl('/category/list', array('id'=>$oCategory->id)));
			}
			}
			$aMenuItems[] = array(
				'label'=>$oDirection->name,
				'url'=>$this->createUrl('/category/direction',
						array('id'=>$oDirection->id, ) ),
				'itemOptions' => array( 'class'=>'menu_category menu_category_'.$oDirection->id ),
				'items'=> $aSubmenuItems,
				'submenuOptions' => array('class'=>'submenuMenu'),
			);
		}

		$this->widget('zii.widgets.CMenu',array(
				'items'=> $aMenuItems ,
				'activeCssClass' => 'activeMenu',
				'activateItems' => true,
			));

		?>
	</div>
	<?php echo $content; ?>
</div>
<div id="footer">
<ul class="footer_menu">
	<li><a href="<?=$this->createUrl('/site/page',array('view'=>'contacts'))?>">Контакты</a></li>
	<li><a href="<?=$this->createUrl('/site/page',array('view'=>'about'))?>">О компании</a></li>
	<li><a href="<?=$this->createUrl('/site/page',array('view'=>'partnership'))?>">Партнерам</a></li>
	<li><a href="<?=$this->createUrl('/site/page',array('view'=>'offer'))?>">Договор оферты</a></li>
</ul>
</div>
</body>
</html>
