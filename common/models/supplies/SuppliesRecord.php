<?php

namespace common\models\supplies;

use Yii;
use common\models\member\Member;
/**
 * This is the model class for table "rf_supplies_record".
 *
 * @property int $id 主键ID
 * @property int $material_id 物资ID
 * @property int $type 操作类型：1=入库，2=出库
 * @property int $quantity 数量
 * @property float|null $price 单价（可与物资表不同）
 * @property int|null $operator_id 操作人ID
 * @property string|null $remark 备注信息
 * @property int|null $created_at 创建时间
 * @property int|null $recipient 领取人
 */
class SuppliesRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rf_supplies_record';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operator_id', 'remark', 'created_at'], 'default', 'value' => null],
            [['price'], 'default', 'value' => 0.00],
            [['material_id', 'type', 'quantity','recipient'], 'required'],
            [['material_id', 'type', 'quantity', 'operator_id', 'created_at'], 'integer'],
            [['price'], 'number'],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键ID',
            'material_id' => '物资ID',
            'type' => '操作类型：1=入库，2=出库',
            'quantity' => '数量',
            'price' => '单价（可与物资表不同）',
            'operator_id' => '操作人ID',
            'remark' => '备注信息',
            'recipient' => '领取人',
            'created_at' => '创建时间',
        ];
    }
    
    public function getMaterial()
    {
        return $this->hasOne(Supplies::class, ['id' => 'material_id']);
    }

    public function getUser()
    {
        return $this->hasOne(Member::class, ['id' => 'user_id']);
    }
}
