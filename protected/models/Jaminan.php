<?php

/**
 * This is the model class for table "jaminan".
 *
 * The followings are the available columns in table 'jaminan':
 * @property integer $id
 * @property integer $jenis_jaminan_id
 * @property integer $propinsi_id
 * @property string $alamat
 * @property string $latitude
 * @property string $longitude
 * @property string $info
 *
 * The followings are the available model relations:
 * @property Foto[] $fotos
 * @property JenisJaminan $jenisJaminan
 * @property Propinsi $propinsi
 * @property SuratKepemilikan[] $suratKepemilikans
 */
class Jaminan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Jaminan the static model class
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
		return 'jaminan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jenis_jaminan_id, propinsi_id, alamat', 'required'),
			array('jenis_jaminan_id, propinsi_id', 'numerical', 'integerOnly'=>true),
			array('alamat', 'length', 'max'=>200),
			array('latitude, longitude', 'length', 'max'=>45),
			array('info', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, jenis_jaminan_id, propinsi_id, alamat, latitude, longitude, info', 'safe', 'on'=>'search'),
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
			'fotos' => array(self::HAS_MANY, 'Foto', 'jaminan_id'),
			'jenisJaminan' => array(self::BELONGS_TO, 'JenisJaminan', 'jenis_jaminan_id'),
			'propinsi' => array(self::BELONGS_TO, 'Propinsi', 'propinsi_id'),
			'suratKepemilikans' => array(self::HAS_MANY, 'SuratKepemilikan', 'jaminan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'jenis_jaminan_id' => 'Jenis Jaminan',
			'propinsi_id' => 'Propinsi',
			'alamat' => 'Alamat',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'info' => 'Info',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('jenis_jaminan_id',$this->jenis_jaminan_id);
		$criteria->compare('propinsi_id',$this->propinsi_id);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('info',$this->info,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}