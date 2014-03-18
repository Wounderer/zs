<?php
/**
 * @var $aActionImages
 * @var $oActionImage ActionImages
 * @var $oUploadForm ImageUploadForm
 */
$iActionId = Yii::app()->request->getQuery('id');
$oForm = $this->beginWidget('CActiveForm', array(
		'id'=>'editActionForm',
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	));

?>
<div>
	<a href="<?=$this->createUrl('/admin/editAction', array('id'=>$iActionId))?>">Основное</a>
	<a href="<?=$this->createUrl('/admin/editVariations', array('id'=>$iActionId))?>">Вариации</a>
	<span>Изображения</span>
</div>

<table class="table" style="width:75%">
	<tr>
		<td><?= $oForm->labelEx($oUploadForm, 'filename')?></td>
		<td>
			<?= $oForm->fileField($oUploadForm, 'filename', array('class'=>'form-control datepicker'))?>
			<?= $oForm->error($oUploadForm, 'filename')?></td>
		<td></td>
		<td><?php echo CHtml::submitButton('Загрузить', array('class'=>'btn btn-success')); ?></td>
	</tr>
</table>
<?php
$this->endWidget();
if ( empty($aActionImages) ) {
	echo 'No images';
	return true;
}
?>

<?php
foreach ( $aActionImages as $oActionImage ) {
	echo '<div style="display:inline-block; width:200px; text-align:center; margin:3px; border:solid 1px black;">
	<p>' . $oActionImage->filename . '</p>
	<img src="/images/actions/' .$oActionImage->action_id . '/' . $oActionImage->filename . '" width="200" />
	<a href="' . $this->createUrl('admin/editImages', array('id'=>$oActionImage->action_id, 'delete_id'=> $oActionImage->id)) . '">Удалить</a></div>';
}
?>
