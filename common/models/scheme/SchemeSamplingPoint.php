<?php

namespace common\models\scheme;

use Yii;

/**
 * This is the model class for table "rf_scheme_sampling_point".
 *
 * @property int $id 主键
 * @property int $detail_id 关联方案明细ID
 * @property string $point_name 点位名称
 * @property string|null $point_desc 点位说明
 * @property int|null $duration 时间（单位：天）
 * @property int|null $frequency 频次（次/天）
 * @property string|null $frequency_desc 频次说明
 * @property string|null $remark 备注
 *
 * @property SchemeDetail $detail
 */
class SchemeSamplingPoint extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rf_scheme_sampling_point';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['point_desc', 'duration', 'frequency', 'frequency_desc', 'remark'], 'default', 'value' => null],
            [['detail_id', 'point_name'], 'required'],
            [['detail_id', 'duration', 'frequency'], 'integer'],
            [['remark'], 'string'],
            [['point_name', 'point_desc', 'frequency_desc'], 'string', 'max' => 255],
            [['detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => SchemeDetail::class, 'targetAttribute' => ['detail_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'detail_id' => '关联方案明细ID',
            'point_name' => '点位名称',
            'point_desc' => '点位说明',
            'duration' => '时间（单位：天）',
            'frequency' => '频次（次/天）',
            'frequency_desc' => '频次说明',
            'remark' => '备注',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetail()
    {
        return $this->hasOne(SchemeDetail::class, ['id' => 'detail_id']);
    }
}
