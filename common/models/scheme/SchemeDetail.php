<?php

namespace common\models\scheme;

use Yii;

/**
 * This is the model class for table "rf_scheme_detail".
 *
 * @property int $id 主键
 * @property int $scheme_id 关联方案ID
 * @property string $detail_name 明细名称（分组名称）
 * @property string|null $project_type 项目类型（下拉选择）
 * @property string|null $standard_name 判定标准名称
 * @property string|null $standard_desc 判定标准说明
 * @property string|null $detection_items 检测项目（多行输入）
 *
 * @property Scheme $scheme
 * @property SchemeSamplingPoint[] $schemeSamplingPoints
 */
class SchemeDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rf_scheme_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_type', 'standard_name', 'standard_desc', 'detection_items'], 'default', 'value' => null],
            [['scheme_id', 'detail_name'], 'required'],
            [['scheme_id'], 'integer'],
            [['standard_desc', 'detection_items'], 'string'],
            [['detail_name', 'standard_name'], 'string', 'max' => 255],
            [['project_type'], 'string', 'max' => 100],
            [['scheme_id'], 'exist', 'skipOnError' => true, 'targetClass' => Scheme::class, 'targetAttribute' => ['scheme_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'scheme_id' => '关联方案ID',
            'detail_name' => '明细名称（分组名称）',
            'project_type' => '项目类型（下拉选择）',
            'standard_name' => '判定标准名称',
            'standard_desc' => '判定标准说明',
            'detection_items' => '检测项目（多行输入）',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScheme()
    {
        return $this->hasOne(Scheme::class, ['id' => 'scheme_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoints()
    {
        return $this->hasMany(SchemeSamplingPoint::class, ['detail_id' => 'id']);
    }
}
