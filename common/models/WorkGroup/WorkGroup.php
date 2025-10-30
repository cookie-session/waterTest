<?php

namespace common\models\WorkGroup;

use Yii;
use common\models\Site\Site;
/**
 * This is the model class for table "rf_work_group".
 *
 * @property int $id 主键ID
 * @property string $name 小组名称
 * @property string $site_id 所属公司
 * @property string|null $description 备注说明
 * @property int|null $created_at 创建时间
 * @property int|null $updated_at 更新时间
 */
class WorkGroup extends \yii\db\ActiveRecord
{

    public $selectedMembers = []; // 用于绑定 DualListbox
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rf_work_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['name', 'site_id'], 'required'],
            [['created_at', 'updated_at','site_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['selectedMembers'], 'required', 'message' => '请至少选择一个小组成员']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键ID',
            'name' => '小组名称',
            'site_id' => '所属站点',
            'description' => '备注说明',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    public function beforeSave($insert)
    {
        if ($insert && empty($this->created_at)) {
            $this->created_at = time();
        }
        return parent::beforeSave($insert);
    }

    // 获取已选成员 ID
    public function getMemberIds()
    {
        return WorkGroupMember::find()
            ->select('member_id')
            ->where(['group_id' => $this->id])
            ->column();
    }

    public function getMembers()
    {
        return $this->hasMany(WorkGroupMember::class, ['group_id' => 'id'])->with('member');
    }

    public function getSite()
    {
        return $this->hasOne(Site::class, ['id' => 'site_id']);
    }
}
