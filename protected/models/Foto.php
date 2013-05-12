<?php

/**
 * This is the model class for table "foto".
 *
 * The followings are the available columns in table 'foto':
 * @property integer $id
 * @property integer $jaminan_id
 * @property string $source
 * @property string $type
 * @property integer $isThumbnail
 *
 * The followings are the available model relations:
 * @property Jaminan $jaminan
 */
class Foto extends CActiveRecord
{
	const TYPE_DEPAN = 'D';
	const TYPE_DALAM = 'I';
	const TYPE_LAINNYA = 'L';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Foto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'foto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jaminan_id, type', 'required'),
			array('jaminan_id, isThumbnail', 'numerical', 'integerOnly'=>true),
			array('source', 'length', 'max'=>100),
			array('type', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, jaminan_id, source, type, isThumbnail', 'safe', 'on'=>'search'),
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
			'jaminan' => array(self::BELONGS_TO, 'Jaminan', 'jaminan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'jaminan_id' => 'Jaminan',
			'source' => 'Source',
			'type' => 'Type',
			'isThumbnail' => 'Thumbnail',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($type)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('jaminan_id',$this->jaminan_id);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('type',$type);
		$criteria->compare('isThumbnail',$this->isThumbnail);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}