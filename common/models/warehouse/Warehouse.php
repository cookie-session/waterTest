<?php

namespace common\models\warehouse;

use Yii;

/**
 * This is the model class for table "rf_warehouse".
 *
 * @property int $id 仓库ID
 * @property string $name 仓库名称
 * @property string|null $address 仓库地址
 * @property string|null $site 所属站点
 * @property string|null $contact_person 联系人
 * @property string|null $contact_phone 联系方式
 * @property string|null $note 备注
 * @property int $status 状态：1=启用，0=停用
 * @property int|null $created_at 创建时间
 * @property int|null $updated_at 更新时间
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rf_warehouse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'site', 'contact_person', 'contact_phone', 'note', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['name'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'site'], 'string', 'max' => 100],
            [['address', 'note'], 'string', 'max' => 255],
            [['contact_person', 'contact_phone'], 'string', 'max' => 50],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '仓库ID',
            'name' => '仓库名称',
            'address' => '仓库地址',
            'site' => '所属站点',
            'contact_person' => '联系人',
            'contact_phone' => '联系方式',
            'note' => '备注',
            'status' => '状态：1=启用，0=停用',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
