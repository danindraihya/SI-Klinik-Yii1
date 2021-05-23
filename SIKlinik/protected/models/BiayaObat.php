<?php

/**
 * This is the model class for table "biaya_obat".
 *
 * The followings are the available columns in table 'biaya_obat':
 * @property integer $id
 * @property integer $pasien_id
 * @property integer $obat_id
 * @property integer $jumlah
 * @property integer $total_harga
 * @property integer $status
 * @property string $tanggal_periksa
 *
 * The followings are the available model relations:
 * @property Obat $obat
 * @property Pasien $pasien
 */
class BiayaObat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'biaya_obat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pasien_id, obat_id, jumlah, total_harga, tanggal_periksa', 'required'),
			array('pasien_id, obat_id, jumlah, total_harga, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pasien_id, obat_id, jumlah, total_harga, status, tanggal_periksa', 'safe', 'on'=>'search'),
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
			'obat' => array(self::BELONGS_TO, 'Obat', 'obat_id'),
			'pasien' => array(self::BELONGS_TO, 'Pasien', 'pasien_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pasien_id' => 'Pasien',
			'obat_id' => 'Obat',
			'jumlah' => 'Jumlah',
			'total_harga' => 'Total Harga',
			'status' => 'Status',
			'tanggal_periksa' => 'Tanggal Periksa',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('pasien_id',$this->pasien_id);
		$criteria->compare('obat_id',$this->obat_id);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('total_harga',$this->total_harga);
		$criteria->compare('status',$this->status);
		$criteria->compare('tanggal_periksa',$this->tanggal_periksa,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BiayaObat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
