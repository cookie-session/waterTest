<?php

namespace common\models\scheme;

use Yii;

/**
 * This is the model class for table "rf_scheme".
 *
 * @property int $id 主键
 * @property string $name 方案名称
 * @property string $entrust_company 委托单位
 * @property string|null $company_address 单位地址
 * @property string|null $entrust_contact 委托联系人
 * @property string|null $entrust_phone 委托联系方式
 * @property string|null $inspect_company 受检单位
 * @property string|null $display_name 单位全称（报告显示）
 * @property string|null $detection_type 检测类型（废气/废水/噪声等）
 * @property string|null $remark 方案总体说明或备注
 * @property int|null $created_at 创建时间
 * @property int|null $updated_at 更新时间
 *
 * @property SchemeDetail[] $schemeDetails
 */
class Scheme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rf_scheme';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_address', 'entrust_contact', 'entrust_phone', 'inspect_company', 'display_name', 'detection_type', 'remark', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['name', 'entrust_company'], 'required'],
            [['remark'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'entrust_company', 'company_address', 'inspect_company', 'display_name'], 'string', 'max' => 255],
            [['entrust_contact', 'detection_type'], 'string', 'max' => 100],
            [['entrust_phone'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'name' => '方案名称',
            'entrust_company' => '委托单位',
            'company_address' => '单位地址',
            'entrust_contact' => '委托联系人',
            'entrust_phone' => '委托联系方式',
            'inspect_company' => '受检单位',
            'display_name' => '单位全称（报告显示）',
            'detection_type' => '检测类型（废气/废水/噪声等）',
            'remark' => '方案总体说明或备注',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasMany(SchemeDetail::class, ['scheme_id' => 'id']);
    }
}
