<?php


class ActionVariationForm extends CFormModel
{

	public $name;
	public $description;
	public $cost;
	public $discount;
	public $regular_price;
	public $discount_price;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('name, description, cost', 'required'),

		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'name'=>'Название вариации',
			'description'=>'Описание вариации',
			'cost'=>'Стоимость купона',
			'regular_price'=>'Цена без купона',
			'discount'=>'Размер скидки',
			'discount_price'=>'Стоимость с купоном',
		);
	}

}
