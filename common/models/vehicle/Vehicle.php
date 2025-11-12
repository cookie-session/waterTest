<?php

namespace common\models\vehicle;

use Yii;

/**
 * This is the model class for table "rf_vehicle".
 *
 * @property int $id 主键
 * @property string $plate_number 车牌号
 * @property string|null $brand 品牌型号
 * @property int|null $type 车辆类型：1=小货车，2=中型货车，3=厢式货车，4=其他
 * @property int|null $status 状态：1=可用，0=停用，2=维修中
 * @property string|null $insurance_expire 保险到期日期
 * @property string|null $annual_check_expire 年检到期日期
 * @property string|null $photo 车辆照片
 * @property string|null $remark 备注
 * @property int|null $created_at 创建时间
 * @property int|null $updated_at 更新时间
 */
class Vehicle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rf_vehicle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand', 'insurance_expire', 'annual_check_expire', 'photo', 'remark', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['plate_number'], 'required'],
            [['type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['insurance_expire', 'annual_check_expire'], 'safe'],
            [['remark'], 'string'],
            [['plate_number'], 'string', 'max' => 20],
            [['brand'], 'string', 'max' => 50],
            [['photo'], 'string', 'max' => 255],
            [['plate_number'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'plate_number' => '车牌号',
            'brand' => '品牌型号',
            'type' => '车辆类型：1=小货车，2=中型货车，3=厢式货车，4=其他',
            'status' => '状态：1=可用，0=停用，2=维修中',
            'insurance_expire' => '保险到期日期',
            'annual_check_expire' => '年检到期日期',
            'photo' => '车辆照片',
            'remark' => '备注',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
