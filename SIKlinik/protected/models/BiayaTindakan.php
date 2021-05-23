<?php

/**
 * This is the model class for table "biaya_tindakan".
 *
 * The followings are the available columns in table 'biaya_tindakan':
 * @property integer $id
 * @property integer $pasien_id
 * @property integer $user_id
 * @property integer $tindakan_id
 * @property integer $total_harga
 * @property integer $status
 * @property string $tanggal_periksa
 *
 * The followings are the available model relations:
 * @property Pasien $pasien
 * @property Tindakan $tindakan
 * @property User $user
 */
class BiayaTindakan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'biaya_tindakan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pasien_id, user_id, tindakan_id, total_harga, tanggal_periksa', 'required'),
			array('pasien_id, user_id, tindakan_id, total_harga, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pasien_id, user_id, tindakan_id, total_harga, status, tanggal_periksa', 'safe', 'on'=>'search'),
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
			'pasien' => array(self::BELONGS_TO, 'Pasien', 'pasien_id'),
			'tindakan' => array(self::BELONGS_TO, 'Tindakan', 'tindakan_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
			'user_id' => 'User',
			'tindakan_id' => 'Tindakan',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('tindakan_id',$this->tindakan_id);
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
	 * @return BiayaTindakan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
