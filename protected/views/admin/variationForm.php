<?php
/**
 * @var $oVariationForm actionVariationForm
 */
$oForm = $this->beginWidget('CActiveForm', array(
		'id'=>'editActionForm',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	));
$iActionId = Yii::app()->request->getQuery('id');
?>
<div>
	<span>Основное</span>
	<a href="<?=$this->createUrl('/admin/editVariations', array('id'=>$iActionId))?>">Вариации</a>
	<a href="<?=$this->createUrl('/admin/editImages', array('id'=>$iActionId))?>">Изображения</a>
</div>
<hr />
<table class="table" style="width:70%">
			<tr>
				<td><?= $oForm->labelEx($oActionForm, 'is_active')?></td>
<td>
	<?= $oForm->checkBox($oActionForm, 'is_active', array('class'=>'form-control'))?>
	<?= $oForm->error($oActionForm, 'is_active')?>
</td>
</tr>
<tr>
	<td><?= $oForm->labelEx($oActionForm, 'title')?></td>
	<td>
		<?= $oForm->textField($oActionForm, 'title', array('class'=>'form-control'))?>
		<?= $oForm->error($oActionForm, 'title')?>
	</td>
</tr>
<tr>
	<td><?= $oForm->labelEx($oActionForm, 'description')?></td>
	<td>
		<?= $oForm->textArea($oActionForm, 'description', array('class'=>'form-control'))?>
		<?= $oForm->error($oActionForm, 'description')?>
	</td>
</tr>
<tr>
	<td><?= $oForm->labelEx($oActionForm, 'category')?></td>
	<td>
		<?= $oForm->dropDownList($oActionForm, 'category', $aCategoryesList, array('class'=>'form-control'))?>
		<?= $oForm->error($oActionForm, 'category')?>
	</td>
</tr>
<tr>
	<td><?= $oForm->labelEx($oActionForm, 'date_start')?></td>
	<td>
		<?= $oForm->textField($oActionForm, 'date_start', array('class'=>'form-control datepicker'))?>
		<?= $oForm->error($oActionForm, 'date_start')?>
	</td>
</tr>
<tr>
	<td><?= $oForm->labelEx($oActionForm, 'date_end')?></td>
	<td>
		<?= $oForm->textField($oActionForm, 'date_end', array('class'=>'form-control datepicker'))?>
		<?= $oForm->error($oActionForm, 'date_end')?>
	</td>
</tr>
<tr>
	<td><?= $oForm->labelEx($oActionForm, 'date_exp')?></td>
	<td>
		<?= $oForm->textField($oActionForm, 'date_exp', array('class'=>'form-control datepicker'))?>
		<?= $oForm->error($oActionForm, 'date_exp')?>
	</td>
</tr>


</table>

<div class="row buttons">
	<?php echo CHtml::submitButton('Сохранить', array('class'=>'btn btn-success')); ?>
</div>
<?php $this->endWidget(); ?>