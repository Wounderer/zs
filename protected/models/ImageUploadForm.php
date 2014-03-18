<?php


class ImageUploadForm extends CFormModel
{
	public $id;
	public $filename;
	public $order;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('filename', 'file', 'types'=>'jpg, jpeg, png', 'allowEmpty'=>false),

		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'filename'=>'Файл изображения',
			'order'=>'Порядок сортировки',
		);
	}

}
