<?php

namespace common\models\Site;

use Yii;

/**
 * This is the model class for table "rf_site".
 *
 * @property int $id
 * @property string $name 站点名称
 * @property string $company 所属公司名称
 * @property string|null $province 省份
 * @property string|null $city 城市
 * @property string|null $district 区县
 * @property string|null $address 详细地址
 * @property int|null $created_at 创建时间
 * @property int|null $updated_at 更新时间
 */
class Site extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rf_site';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province', 'city', 'district', 'address', 'created_at', 'updated_at','status'], 'default', 'value' => null],
            [['name', 'company'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'company'], 'string', 'max' => 100],
            [['province', 'city', 'district'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '站点名称',
            'company' => '所属公司名称',
            'province' => '省份',
            'city' => '市',
            'district' => '区',
            'address' => '详细地址',
            'created_at' => '添加时间',
            'updated_at' => 'Updated At',
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert && empty($this->created_at)) {
            $this->created_at = time();
        }
        return parent::beforeSave($insert);
    }

}
