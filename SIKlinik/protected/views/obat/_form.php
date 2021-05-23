<?php
/* @var $this ObatController */
/* @var $model Obat */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'obat-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nama', array('class' => 'form-label', 'for' => 'nama')); ?>
		<?php echo $form->textField($model,'nama',array('class' => 'form-control', 'id' => 'nama', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nama'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'harga', array('class' => 'form-label', 'for' => 'harga')); ?>
		<?php echo $form->textField($model,'harga', array('class' => 'form-control', 'id' => 'harga')); ?>
		<?php echo $form->error($model,'harga'); ?>
	</div>
	<br>

	<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary btn-sm')); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->