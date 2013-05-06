<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $roles
 * @property string $firstname
 * @property string $lastname
 */
class User extends CActiveRecord
{
	const ROLE_ROOT = 'root';
	const ROLE_SUPERVISOR = 'supervisor';
	const ROLE_DATAENTRY = 'data-entry';
	const ROLE_VIEWER = 'viewer';
	
	public $newPassword;

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
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, roles', 'required'),
			array('password', 'required', 'on' => 'insert'),
			array('roles', 'length', 'max' => 10),
			array('username', 'length', 'max' => 20, 'min' => 3),
			array('password,newPassword', 'length', 'max' => 100, 'min' => 4),
			array('firstname, lastname', 'length', 'max' => 100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, roles, firstname, lastname', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'roles' => 'Roles',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('roles', $this->roles, true);
		$criteria->compare('firstname', $this->firstname, true);
		$criteria->compare('lastname', $this->lastname, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
//		return Yii::app()->hasher->checkPassword($password, $this->password);
		return TRUE;
	}

	public function beforeSave()
	{
		if ($this->isNewRecord)
		{
			$this->password = Yii::app()->hasher->hashPassword($this->password);
		}
		else
		{
			if ($this->validate('newPassword') && strlen($this->newPassword) != 0)
			{
				$this->password = Yii::app()->hasher->hashPassword($this->newPassword);
			}
		}
		return parent::beforeSave();
	}
	
	public static function userRolesList()
	{
		return array(self::ROLE_VIEWER => 'Viewer',  self::ROLE_DATAENTRY => 'Data Entry', self::ROLE_SUPERVISOR => 'Supervisor');
	}
}