<?php


class CommentForm extends CFormModel
{
	public $content;
	public $user_id;
	public $is_active;
	public $action_id;
	public $is_review;
	public $rate;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('content, rate', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'content'=>'Ваш комментарий',
			'rate'=>'Ваша оценка',

		);
	}

}
