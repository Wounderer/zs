<?php


class ActionForm extends CFormModel
{
	public $id;
	public $title;
	public $description;
	public $is_active;
	public $category;
	public $date_start;
	public $date_end;
	public $date_exp;
	public $terms;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('title, description, date_start, date_end, date_exp, category, terms', 'required'),
			array('is_active', 'boolean')
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'title'=>'Название акции',
			'description'=>'Описание акции',
			'category'=>'Категория акции',
			'date_start'=>'Начало публикации акции',
			'date_end'=>'Окончание публикации акции',
			'date_exp'=>'Окончание срока действия купонов',
			'is_active'=>'Акция включена',
			'terms'=>'Условия акции',

		);
	}

}
