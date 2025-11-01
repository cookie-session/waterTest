<?php

namespace common\models\supplies;

use Yii;

/**
 * This is the model class for table "rf_supplies_type".
 *
 * @property int $id 主键ID
 * @property string $name 类型名称
 * @property int|null $sort 排序值
 * @property int|null $status 状态：1=启用，0=停用
 * @property int|null $created_at 创建时间
 */
class SuppliesType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rf_supplies_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'default', 'value' => null],
            [['sort'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => 1],
            [['name'], 'required'],
            [['sort', 'status', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键ID',
            'name' => '类型名称',
            'sort' => '排序值',
            'status' => '状态：1=启用，0=停用',
            'created_at' => '创建时间',
        ];
    }
}
