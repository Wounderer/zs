<?php
/**
 * Этот файл нигде не подключается
 * и его не нужно подключать
 * нужен только для того чтобы в
 * IDE выскакивали подсказки при Yii::app()->|
 *
 * @property CPhpMessageSource $coreMessages
 * @property CDbConnection $db
 * @property CPhpMessageSource $messages
 * @property CErrorHandler $errorHandler
 * @property CSecurityManager $securityManager
 * @property CStatePersister $statePersister
 * @property CUrlManager $urlManager
 * @property HelperComponent $helper
 * @property CHttpRequest $request
 * @property CFormatter $format
 *
 *
 * @property CHttpSession $session
 * @property CAssetManager $assetManager
 * @property CThemeManager $themeManager
 * @property ClientScript $clientScript
 * @property CWidgetFactory $widgetFactory
 * @property MrFavorite $MrFavorite
 *
 *
 * @property WebUser|AdminWebUser $user
 * @property CDbAuthManager $authManager
 * @property CDbConnection $db_test
 * @property CDbConnection $db_log
 * @property CDbConnection $db_old_ip
 * @property CDbConnection $db_log_test
 * @property CDbConnection $db_subscribe коннект к БД рассылок
 * @property CDbConnection $db_mailer_1 коннект к БД рассыльщика №1
 * @property CDbConnection $db_mailer_2 коннект к БД рассыльщика №2
 * @property CDbConnection $db_kladr
 * @property CDummyCache $cache
 * @property CFileCache $fileCache
 * @property CLogRouter $log
 * @property Crypt $crypt
 * @property BasketComponent $basket
 * @property BasketSelectAddresshelper $basketSelectAddresshelper
 * @property OrderSiteControllerComponent $order
 * @property UserMoneyComponent $userMoney
 * @property PrepayManagerComponent $prepayManager
 * @property FakeEMailer $mailer
 * @property Observer $observer
 * @property LogErrorManager $logErrorManager
 * @property Calendar $calendar
 * @property DeliveryDayCalculator $deliveryDayCalculator
 * @property CrossUrl $url
 * @property EmailTemplaterParam $emailTemplaterParam
 * @property DeliveryRateComponent $deliveryRate
 * @property EAuth $eauth
 * @property SDbAuthManager $authAdminManager
 *
 *
 * @property ImportAction $importFrom1cAction
 * @property ImportActionI3 $importActionI3
 * @property ExportOrder $exportTo1cOrder
 * @property ExportOrdersProtocol $exportTo1cOrdersProtocol
 * @property MrExportOrdersProtocol $mrExportTo1cOrdersProtocol
 * @property ExportOrderPreCollect $exportTo1cOrderPreCollect
 * @property ExportOrdersCorrectQuery $exportTo1cOrdersCorrectQuery
 * @property idsIpOrdersCorrectTo1cQuery $ordersCorrectsTo1cQuery
 * @property Interaction1c $interaction1c
 * @property IdpActiveRecordHelper $arHelper
 * @property OrderNewId $newIdMaker
 * @property MailQueue $mailQueue
 * @property SubscribeConfig $subscribeConfig
 * @property LogHelper $logHelper
 * @property ProductPictureLinker $productPictureLinker
 * @property ProductFileIo $productFileIo
 * @property ActionProductLinker $actionProductLinker
 * @property dpsFiasSearcher $kladr
 * @property dpsFiasSearcher $kladrModel
 * @property GoogleAnalyticsComponent $ga
 * @property FlocktoryComponent $flocktory
 * @property ActionTextHelper $actionTextHelper
 * @property Stemming $stem
 * @property ProductWelcomeComponent $productWelcome
 * @property ApiConsumer $apiConsumer
 * @property QuizRating $quizRating
 * @property MrImportProducts $importMrProducts
 * @property FactoryComponent $factory
 * @property AcpUrl $acpUrl
 * @property ConsoleComponent $console
 * @property ProductBonusCalc $productBonusCalc
 * @property SupportComponent $support
 * @property Utils $utils
 * @property DeliveryNotes $deliveryNotes
 * @property ExportOrderI3 $exportOrderI3
 * @property Otrs $otrs
 * @property CallcenterInitConfirm $callcenterInitConfirm
 * @property CallcenterInitPreCollect $callcenterInitPreCollect
 * @property CallcenterQueue $callcenterQueue
 */

class Yii extends YiiBase {
	/**
	 * @return IdpApplication
	 */
	public static function app() {
		return parent::app();
	}
}