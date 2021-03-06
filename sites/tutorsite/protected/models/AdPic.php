<?php
/**********************************************************************************
* DClassifieds                                                                    *
* Open-Source Project Inspired by Dinko Georgiev (webmaster@dclassifieds.eu)      *
* =============================================================================== *
* Software Version:           0.1b                                           	  *
* Software by:                Dinko Georgiev     								  *
* Support, News, Updates at:  http://www.dclassifieds.eu                       	  *
***********************************************************************************
* This program is free software; you may redistribute it and/or modify it under   *
* the terms of the provided license.          									  *
*                                                                                 *
* This program is distributed in the hope that it is and will be useful, but      *
* WITHOUT ANY WARRANTIES; without even any implied warranty of MERCHANTABILITY    *
* or FITNESS FOR A PARTICULAR PURPOSE.                                            *
*                                                                                 *
* See the "license.txt" file for details of the license.                          *
* The latest version can always be found at http://www.gnu.org/licenses/gpl.txt   *
**********************************************************************************/

/**
 * This is the model class for table "ad_pic".
 *
 * The followings are the available columns in table 'ad_pic':
 * @property string $ad_pic_id
 * @property string $ad_id
 * @property string $ad_pic_path
 */
class AdPic extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AdPic the static model class
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
		return 'ad_pic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ad_id', 'required'),
			array('ad_id', 'length', 'max'=>10),
			array('ad_pic_path', 'length', 'max'=>255),
			array('ad_id', 'numerical'),
			array('ad_id, ad_pic_path', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ad_pic_id, ad_id, ad_pic_path', 'safe', 'on'=>'search'),
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
			'ad_pic_id' 	=> Yii::t('admin','Ad Pic'),
			'ad_id' 		=> Yii::t('admin','AdId'),
			'ad_pic_path' 	=> Yii::t('admin','Ad Pic Path'),
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

		$criteria->compare('ad_pic_id',$this->ad_pic_id,true);
		$criteria->compare('ad_id',$this->ad_id,true);
		$criteria->compare('ad_pic_path',$this->ad_pic_path,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	function getSmallPic( $_ad_id )
	{
		//$ret = Yii::app()->theme->baseUrl . '/front/i/no_photo_small.jpg';
		$ret = Yii::app()->baseUrl . '/public/images/caring.png';
		$criteria = new CDbCriteria();
		$criteria->condition = "ad_id = '{$_ad_id}'";
		$criteria->limit = 1;
		$criteria->order = 'ad_pic_id ASC';
		$pic = $this->find( $criteria );
		
		if(!empty($pic)){
			if(is_file(PATH_UF_CLASSIFIEDS . 'small-' . $pic->ad_pic_path)){
				$ret = SITE_UF_CLASSIFIEDS . 'small-' . $pic->ad_pic_path;
			}
		}
		
		return $ret;
	}
}