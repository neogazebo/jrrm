<?php

/**
 * This is the model class for table "jaminan".
 *
 * The followings are the available columns in table 'jaminan':
 * @property integer $id
 * @property integer $jenis_jaminan_id
 * @property integer $propinsi_id
 * @property string $kecamatan
 * @property string $kelurahan
 * @property string $kota
 * @property string $alamat
 * @property string $latitude
 * @property string $longitude
 * @property string $info
 * @property integer $isApproved
 * @property string $status
 * @property integer $harga
 *
 * The followings are the available model relations:
 * @property Foto[] $fotos
 * @property JenisJaminan $jenisJaminan
 * @property Propinsi $propinsi
 * @property RangeHarga $rangeHarga
 * @property SuratKepemilikan[] $suratKepemilikans
 */
class Jaminan extends CActiveRecord
{
	public $sJenisJaminan;
	public $sPropinsi;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Jaminan the static model class
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
			array('jenis_jaminan_id, propinsi_id', 'required'),
			array('harga,jenis_jaminan_id, propinsi_id, isApproved', 'numerical', 'integerOnly' => true),
			array('kecamatan, kelurahan, kota, latitude, longitude', 'length', 'max' => 45),
			array('status', 'length', 'max' => 6),
			array('alamat, info', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, jenis_jaminan_id, propinsi_id, kecamatan, kelurahan, kota, alamat, latitude, longitude, info, isApproved, status,sJenisJaminan,sPropinsi,sRangeHarga', 'safe', 'on' => 'search'),
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
			'kecamatan' => 'Kecamatan',
			'kelurahan' => 'Kelurahan',
			'kota' => 'Kota',
			'alamat' => 'Alamat',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'info' => 'Info',
			'isApproved' => 'Publish',
			'status' => 'Status',
			'harga' => 'Harga',
			'sJenisJaminan' => 'Jenis Jaminan'
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
		$criteria->with = array('jenisJaminan', 'propinsi');

		$criteria->compare('id', $this->id);
		$criteria->compare('jenis_jaminan_id', $this->jenis_jaminan_id);
		$criteria->compare('propinsi_id', $this->propinsi_id);
		$criteria->compare('kecamatan', $this->kecamatan, true);
		$criteria->compare('kelurahan', $this->kelurahan, true);
		$criteria->compare('kota', $this->kota, true);
		$criteria->compare('alamat', $this->alamat, true);
		$criteria->compare('latitude', $this->latitude, true);
		$criteria->compare('longitude', $this->longitude, true);
		$criteria->compare('info', $this->info, true);
		$criteria->compare('isApproved', $this->isApproved);
		$criteria->compare('status', $this->status, true);
		$criteria->compare('jenisJaminan.name', $this->sJenisJaminan,true);
		$criteria->compare('propinsi.name', $this->sPropinsi,true);


		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array(
				'attributes' => array(
					'sJenisJaminan' => array(
						'asc' => 'jenisJaminan.name',
						'desc' => 'jenisJaminan.name DESC',
					),
					'sPropinsi' => array(
						'asc' => 'propinsi.name',
						'desc' => 'propinsi.name DESC',
					),
					'*',
				),
			),
		));
	}
}