<?php


class CompanyForm extends CFormModel
{
	public $id;
	public $title;
	public $description;
	public $phone;
	public $address;
	public $email;
	public $rate;

	public function rules()
	{
		return array(
			// username and password are required
			array('title, description, phone, address, email', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'title'=>'Название',
			'description'=>'Описание',
			'phone'=>'Телефон',
			'address'=>'Адрес',
			'email'=>'Email',

		);
	}

}
