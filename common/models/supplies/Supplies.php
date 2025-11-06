<?php

namespace common\models\supplies;

use Yii;

/**
 * This is the model class for table "rf_supplies".
 *
 * @property int $id 主键ID
 * @property string|null $number 物资编号
 * @property string|null $image 物资图片
 * @property string $name 物资名称
 * @property int $type_id 物资类型ID
 * @property string|null $brand 品牌
 * @property string|null $model 型号
 * @property string $unit 单位（个/箱/米等）
 * @property int|null $warning_stock 库存警戒值
 * @property float|null $price 物资单价
 * @property string|null $description 物资说明
 * @property int|null $stock 当前库存数量
 * @property int|null $status 状态：1=启用，0=停用
 * @property int|null $created_at 创建时间
 * @property int|null $updated_at 更新时间
 * @property int|null $warehouse_id 仓库ID
 */
class Supplies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rf_supplies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'image', 'brand', 'model_num', 'description', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['stock'], 'default', 'value' => 0],
            [['price'], 'default', 'value' => 0.00],
            [['status'], 'default', 'value' => 1],
            [['number','image','name', 'type_id', 'unit','warehouse_id'], 'required'],
            [['type_id', 'warning_stock', 'stock', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['number'], 'string', 'max' => 60],
            [['image'], 'string', 'max' => 255],
            [['name', 'brand', 'model_num'], 'string', 'max' => 100],
            [['unit'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键ID',
            'number' => '物资编号',
            'image' => '物资图片',
            'name' => '物资名称',
            'type_id' => '物资类型ID',
            'brand' => '品牌',
            'model_num' => '型号',
            'unit' => '单位（个/箱/米等）',
            'warning_stock' => '库存警戒值',
            'price' => '物资单价',
            'description' => '物资说明',
            'stock' => '当前库存数量',
            'status' => '状态：1=启用，0=停用',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'warehouse_id' => '仓库ID',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->created_at = time();
            }
            return true;
        }
        return false;
    }

    public function getWarehouse(){
        return $this->hasOne(\common\models\warehouse\Warehouse::class, ['id' => 'warehouse_id']);
    }
    
    public function getType(){
        return $this->hasOne(SuppliesType::class, ['id' => 'type_id']);
    }
}
