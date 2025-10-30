<?php

namespace common\models\WorkGroup;

use Yii;
use common\models\member\Member;
/**
 * This is the model class for table "rf_work_group_member".
 *
 * @property int $id 主键ID
 * @property int $group_id 小组ID
 * @property int $member_id 用户ID
 * @property string|null $role 组内角色，如组长、成员
 * @property int|null $created_at 加入时间
 */
class WorkGroupMember extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rf_work_group_member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role', 'created_at'], 'default', 'value' => null],
            [['group_id', 'member_id'], 'required'],
            [['group_id', 'member_id', 'created_at'], 'integer'],
            [['role'], 'string', 'max' => 50],
            [['group_id', 'member_id'], 'unique', 'targetAttribute' => ['group_id', 'member_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键ID',
            'group_id' => '小组ID',
            'member_id' => '用户ID',
            'role' => '组内角色，如组长、成员',
            'created_at' => '加入时间',
        ];
    }

    public function getMember()
{
    return $this->hasOne(Member::class, ['id' => 'member_id']); // 必须是 member_id
}
}
