<?php


class RegisterForm extends CFormModel
{
	public $username;
	public $password;
	public $password2;
	public $email;
	public $name;


	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, password2, name, email', 'required',
				'message'=>'Поле "{attribute}" должно быть заполнено.'),
			array('username', 'checkUser'),
			array('password', 'checkPassword'),
			array('email', 'email'),
			array('email', 'checkEmail'),
		);
	}

	public function checkUser() {
		if (User::model()->findAllByAttributes(array('username'=>$this->username) ) ) {
			$this->addError('username', 'Имя пользователя уже используется');
			return false;
		}
		return true;
	}

	public function checkEmail() {
		if (User::model()->findAllByAttributes(array('email'=>$this->email) ) ) {
			$this->addError('email', 'Email уже используется');
			return false;
		}
		return true;
	}

	public function checkPassword() {
		if ($this->password !== $this->password2 ) {
			$this->addError('password', 'Пароль и его подтверждение не совпадают');
			return false;
		}
		return true;
	}
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'Имя пользователя',
			'email'=>'Email',
			'name'=>'Ваше имя',
			'password'=>'Пароль',
			'password2'=>'Подтверждение пароля',
		);
	}

	public function addUser() {
		$oUser = new User();
		$oUser->username = $this->username;
		$oUser->password = crypt($this->password);
		$oUser->email = $this->email;
		$oUser->name = $this->name;
		$oUser->save();

		$oUserIdentity =new UserIdentity($this->username,$this->password);
		$oUserIdentity->authenticate();
		return true;
	}

}
