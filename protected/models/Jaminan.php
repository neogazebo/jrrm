<?php

/**
 * This is the model class for table "jaminan".
 *
 * The followings are the available columns in table 'jaminan':
 * @property integer $id
 * @property string $judul
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
	const STAT_JUAL = 'jual';
	const STAT_LELANG = 'lelang';
	const STAT_LAKU = 'laku';

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
			array('judul, jenis_jaminan_id, propinsi_id, kota, alamat,status,harga', 'required'),
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
			'foto' => array(self::HAS_MANY, 'Foto', 'jaminan_id'),
			'jenisJaminan' => array(self::BELONGS_TO, 'JenisJaminan', 'jenis_jaminan_id'),
			'propinsi' => array(self::BELONGS_TO, 'Propinsi', 'propinsi_id'),
			'suratKepemilikan' => array(self::HAS_MANY, 'SuratKepemilikan', 'jaminan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'judul'=>'Judul',
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
	
	public function getThumbnailImage()
	{
		$thumbnail = '';
		$images = $this->foto;
		
		foreach ($images as $img)
		{
			if($img->isThumbnail)
				$thumbnail = $img->source;
		}
		
		return ($thumbnail) ? $thumbnail : 'default_2.jpg';
	}
	
	
	public function getAllFotoByType($type)
	{
		$criteria = new CDbCriteria;
		$criteria->condition='type=:type';
		$criteria->params=array(':type'=>$type);
		$criteria->AddCondition('LENGTH(source) > 1');
		
		$images = Foto::model()->findAllByAttributes(array('jaminan_id'=>$this->id),$criteria);
		
		$data = array();
		foreach($images as $img)
		{
			array_push($data,array('image'=>Yii::app()->getBaseUrl().'/slir/w600-h290-c600x290'.Yii::app()->getBaseUrl().'/img_jaminan/'.$img->source));
		}
		
		return $data;
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
		$criteria->compare('kota', $this->kota, true);
		$criteria->compare('alamat', $this->alamat, true);
		$criteria->compare('latitude', $this->latitude, true);
		$criteria->compare('longitude', $this->longitude, true);
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
	
	protected function afterSave()
	{
		if($this->isNewRecord)
		{
			$this->latitude = ($this->latitude) ? $this->latitude : '-6.203403';
			$this->longitude = ($this->longitude) ? $this->longitude : '106.823225';
			
			for($i = 1 ; $i <= 9 ; $i++)
			{
				$foto = new Foto;
				$foto->jaminan_id = $this->id;
				switch ($i)
				{
					case ($i == 1 || $i == 2 || $i ==3):
						$foto->type = Foto::TYPE_DEPAN;
						break;
					case ($i == 4 || $i == 5 || $i ==6):
						$foto->type = Foto::TYPE_DALAM;
						break;
					case ($i == 7 || $i == 8 || $i ==9):
						$foto->type = Foto::TYPE_LAINNYA;
						break;
				}
				$foto->save(FALSE );
			}
		}
		return parent::afterSave();
	}
}