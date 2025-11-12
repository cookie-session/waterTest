<?php

namespace common\models\vehicle;

use Yii;

/**
 * This is the model class for table "rf_vehicle_usage".
 *
 * @property int $id 主键
 * @property int $vehicle_id 车辆ID
 * @property int|null $task_id 任务ID（可选）
 * @property float $start_mileage 起始公里数
 * @property string|null $start_mileage_photo 起始公里数照片
 * @property float $end_mileage 结束公里数
 * @property string|null $end_mileage_photo 结束公里数照片
 * @property float|null $toll_fee 过路费
 * @property string|null $toll_photo 过路费凭证照片
 * @property float|null $parking_fee 停车费
 * @property string|null $parking_photo 停车费凭证照片
 * @property int|null $use_member_id 使用人ID
 * @property string|null $remark 备注
 * @property int|null $created_at 创建时间
 * @property int|null $updated_at 更新时间
 */
class VehicleUsage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rf_vehicle_usage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'start_mileage_photo', 'end_mileage_photo', 'toll_photo', 'parking_photo', 'use_member_id', 'remark', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['parking_fee'], 'default', 'value' => 0.00],
            [['vehicle_id'], 'required'],
            [['vehicle_id', 'task_id', 'use_member_id', 'created_at', 'updated_at'], 'integer'],
            [['start_mileage', 'end_mileage', 'toll_fee', 'parking_fee'], 'number'],
            [['remark'], 'string'],
            [['start_mileage_photo', 'end_mileage_photo', 'toll_photo', 'parking_photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'vehicle_id' => '车辆ID',
            'task_id' => '任务ID（可选）',
            'start_mileage' => '起始公里数',
            'start_mileage_photo' => '起始公里数照片',
            'end_mileage' => '结束公里数',
            'end_mileage_photo' => '结束公里数照片',
            'toll_fee' => '过路费',
            'toll_photo' => '过路费凭证照片',
            'parking_fee' => '停车费',
            'parking_photo' => '停车费凭证照片',
            'use_member_id' => '使用人ID',
            'remark' => '备注',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
