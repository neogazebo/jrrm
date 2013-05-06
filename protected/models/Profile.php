<?php

/**
 * This is the model class extends from table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 */
class Profile extends User
{
	public $confirmPassword;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username', 'required'),
			array('username', 'length', 'max' => 20, 'min' => 3),
			array('newPassword,confirmPassword', 'length', 'max' => 100, 'min' => 4),
			array('firstname, lastname', 'length', 'max' => 100),
			array('confirmPassword','compare','compareAttribute'=>'newPassword'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, roles, firstname, lastname', 'safe', 'on' => 'search'),
		);
	}
}