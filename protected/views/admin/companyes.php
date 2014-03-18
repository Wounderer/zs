<?php
/**
* @var $oCompanyForm CompanyForm
 * @var $aCompanyes array
 */
?>
<form action="<?=$this->createUrl('admin/index').'#companyes'?>" method="post">
<?php
echo CHtml::dropDownList('company', 1,
	$aCompanyes, array('class'=>'selectpicker'));
echo CHtml::submitButton('Редактировать',array('class'=>'btn-sm btn-success'));
?>
</form>
<hr />
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm'); ?>

	<?php echo $form->errorSummary($oCompanyForm); ?>

	<div class="row">
		<?php echo $form->label($oCompanyForm,'title'); ?>
		<?php echo $form->textField($oCompanyForm,'title') ?>
	</div>

	<div class="row">
		<?php echo $form->label($oCompanyForm,'description'); ?>
		<?php echo $form->textArea($oCompanyForm,'description') ?>
	</div>

	<div class="row">
		<?php echo $form->label($oCompanyForm,'phone'); ?>
		<?php echo $form->textField($oCompanyForm,'phone') ?>
	</div>

	<div class="row">
		<?php echo $form->label($oCompanyForm,'address'); ?>
		<?php echo $form->textField($oCompanyForm,'address') ?>
	</div>

	<div class="row">
		<?php echo $form->label($oCompanyForm,'email'); ?>
		<?php echo $form->textField($oCompanyForm,'email') ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

	<?php $this->endWidget(); ?>
</div><!-- form -->